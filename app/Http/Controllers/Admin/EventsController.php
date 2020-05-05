<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/** Added this for database Facade support
      as directed by 5.7 documentation
**/
use Illuminate\Support\Facades\DB;

//Import requests
use App\Http\Requests\EventFormRequest;
use App\Http\Requests\EventImageFormRequest;
use App\Http\Requests\EventFormEditRequest;
use App\Http\Requests\EventImageFormEditRequest;

//Import database models
use App\Models\Databases\Event;
use App\Models\Databases\Eventimage;

//Import logic models
use App\Models\Logic\Events;
use App\Models\Logic\Eventimages;

//This is for deleting files from disk
//use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class EventsController extends Controller
{
    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the events list.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /*  List of events begins here */
        $events = (new \App\Models\Logic\Events)->events(10);

        return view('AdminArea.Events', [
            'events' => $events,
        ]);
    }

    /**
     * Show the new post form.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function newEventForm()
    {
        return view('AdminArea.CreateNewEvent');
    }

    /**
     * Post the new form data to database table.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function newEventFormPost(EventFormRequest $request)
    {
        //Instanstiate Event input class model
        $newposts               = new Event;

        //Sanitize inputs
        $newposts->deleted      = 0;
        $newposts->blocked      = 0;
        $newposts->created_at       = now();
        $newposts->updated_at       = now();
        $newposts->title            = filter_var($request->input('Title'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH);
        $newposts->description      = filter_var($request->input('Description'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH);
        $newposts->save();

        session()->flash('infoStatus', 'Good Job! The new event has been created, successfully.');
        
        //Redirect to a routes name
        return redirect()->route('newEventImageForm', [ $newposts->id, ]);
    }

    /**
     * Show form for event's image.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function newEventImageForm($id)
    {
        return view('AdminArea.CreateNewEventImage', [
            'post_id' => $id,
        ]);
    }

    /**
     * Process new photo image upload
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function newEventImageFormPost(EventImageFormRequest $request)
    {
        $image = $request->file('file');
        $hashedName = hash('ripemd160', time()).'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/Events/');
        $image->move($destinationPath, $hashedName);

        //Instantiate event image input class model
        $newpostimages                      = new Eventimage;

        //Sanitize inputs
        $newpostimages->blocked             = 0;
        $newpostimages->deleted             = 0;
        $newpostimages->created_at          = now();
        $newpostimages->updated_at          = now();
        $newpostimages->events_id 			= filter_var($request->input('PostID'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH);
        $newpostimages->caption             = filter_var($request->input('Caption'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH);
        $newpostimages->disk_image_filename = $hashedName;
        $newpostimages->save();

        //This is the message to display        
        session()->flash('infoStatus', 'Good Job! The new event photo has been uploaded, successfully.');

/*        //Redirect to a routes name
        return route('events');*/
        //Redirect to a routes name
        return redirect()->route('newEventImageForm', [ $request->input('PostID'), ]);
    }

    /**
     * Show an event's view.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function viewEvent($id)
    {
        /*  Event's full data here */
        $events = (new \App\Models\Logic\Events)->event($id);

        //Blade view file
        return view('AdminArea.EventView', [
            'post_id' => $id, 'events' => $events,
        ]);
    }

    /**
     * Show form for event's editing.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editEventForm($id)
    {
        /*  Event's full data here */
        $events = (new \App\Models\Logic\Events)->event($id);

        return view('AdminArea.EditEvent', [
        	'events' => $events,
        ]);
    }

    /**
     * Update database, using provided ID for editing event data
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editEventFormPost(EventFormEditRequest $request, $id)
    {
        $data = array(
            //Encode the inputs
            'title' => filter_var($request->input('Title'),  FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_STRIP_LOW),
            'description' => filter_var($request->input('Description'),  FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_STRIP_LOW),
            'updated_at' => now(),
        );

        Event::where('id', $id)
            ->update($data);

        session()->flash('infoStatus', 'Good Job! The event has been changed, successfully.');

        //Redirect to a routes name
        return redirect()->route('eventView', [ $id ]);
    }

    /**
     * Show the application image edit form.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editEventImageForm($ImageId)
    {
        /* Get image's full data */
        $image = (new \App\Models\Logic\Eventimages)->image($ImageId);

        return view('AdminArea.EditEventImage', [
        	'ImageId' => $ImageId, 'image' => $image,
        ]);
    }

    /**
     * Process photo image change upload data
     */
    public function editEventImageFormPost(EventImageFormEditRequest $request, $ImageId)
    {
        /* Create new file name */
        $newImage = $request->file('file');
        $hashedName = hash('ripemd160', time()).'.'.$newImage->getClientOriginalExtension();

        /* Get previous image's full data */
        $image = (new \App\Models\Logic\Eventimages)->image($ImageId);

        /* Delete previous image file from images directory. Set the path to the files directory, including the previous filename */
        $pathToFile = public_path('Events/' . $image->disk_image_filename);

        /* Delete the file using Laravel's file handling method for deleting files */
        File::delete($pathToFile);

        /* Set image directory path & save the uploaded file to the directory */
        $destinationPath = public_path('/Events/');
        $newImage->move($destinationPath, $hashedName);

        /* Update the image entry in database with current upload data */
        $data = array(
            //Sanitize inputs before saving to database
            'caption' => filter_var($request->input('Caption'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH),
            'disk_image_filename' => $hashedName,//filter_var($hashedName, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH),
            'updated_at' => now(),
        );

        Eventimage::where('id', $ImageId)
            ->update($data);

        //This is the message to display        
        session()->flash('infoStatus', 'Good Job! The event photo has been changed, successfully.');

        //Redirect to a routes name
        return redirect()->route('eventView', [ $image->events_id, ]);
    }

    /**
     * Mark an event as blocked as well as any associated photo
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function eventBlock($id, $ReturnPath)
    {
        /* Mark an event blocked */
        (new \App\Models\Logic\Events)->eventBlock($id);

        session()->flash('infoStatus', 'Good Job! The event has been marked as blocked, successfully.');
        
        //Redirect to a routes name
        return redirect()->route('events');
    }

    /**
     * Mark an event as unblocked as well as any associated photo
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function eventUnBlock($id, $ReturnPath)
    {
        /* Mark an event Unblocked */
        (new \App\Models\Logic\Events)->eventUnBlock($id);

        session()->flash('infoStatus', 'Good Job! The event has been unblocked, successfully.');
        
        //Redirect to a routes name
        return redirect()->route('events');
    }

    /**
     * Mark an event as deleted as well as any associated photo
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function eventDelete($id)
    {
        /* Mark an event as deleted as well as any associated photo */
        $vehicles = (new \App\Models\Logic\Events)->eventDelete($id);

        session()->flash('infoStatus', 'Good Job! The event and any associated photo have been deleted, successfully.');
        
        //Redirect to a routes name
        return redirect()->route('events');
    }

    /**
     * Delete a vehicle photo (different route)
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function eventImageDelete2($ImageId, $EventId)
    {
        /*  Get a event's photo filename from the database */
        $imageFilename = (new \App\Models\Logic\Eventimages)->imagefilename2($ImageId);

        /* Set the path to the files directory, include the file name */
        $pathToFile = public_path('Events/' . $imageFilename->disk_image_filename);

        /* Delete the file using Laravel's file handling method for deleting files */
        File::delete($pathToFile);

        /*  Delete a event's photo entry in the database */
        $events = (new \App\Models\Logic\Eventimages)->deleteSingleImage($ImageId);

        /* Set a response message */
        session()->flash('infoStatus', 'Good Job! The photo has been deleted, successfully.');
        
        //Redirect to a routes name
        return redirect()->route('eventView', [$EventId,]);
    }
}
