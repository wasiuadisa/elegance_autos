
@extends('layouts.PublicTemplate2')

@section('preTitle') News & events @endsection

@section('content')
    <section id="about-us" class="container main">
@if (count($recents) > 0)
    @foreach($recents as $recent)
    <?php $imageFilename = (new \App\Models\Logic\Eventimages)->imagefilename($recent->id) ?>
        <div class="row-fluid">
            <div class="span3">
                <div class="box">
                    <a href="index.html">
                        <p><img src="{{ asset('Events') . '/' . $imageFilename->disk_image_filename }}" alt="{{ $recent->title }}" ></p>
                    </a>
                </div>
            </div>
            <div class="span9">
                <a href="index.html" style="color: black;">
                    <h3 style="color: black;">{{ $recent->title }}</h3>
                    {{ $recent->description }}
                </a>
            </div>
        </div>
        <hr>
    @endforeach
@endif
        <div class="row-fluid">
            <div class="span12">
                <div style="background-color: #f5f5f5;">
                    {{ $recents->links() }}
                <?php /*
                    <ul class="pagination pagination-lg">
                        <ul class="pagination" role="navigation">
                            <li class="page-item disabled" aria-disabled="true">
                                <span class="page-link">« Previous</span>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="http://localhost/InfoNet.Space/public/Jobs/Recent?page=2" rel="next">Next »</a>
                            </li>
                        </ul>
                    </ul>
                </div>*/ ?>
            </div>
        </div>

    </section>
    <!-- ./News -->
@endsection
