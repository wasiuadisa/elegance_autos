<?php

namespace App\Models\Logic;

/** Added this for database Facade support
      as directed by 5.7 documentation
**/
use Illuminate\Support\Facades\DB;

// Import relevant database models
use App\User;

class Users
{
   /**
     * Get 
     */
     public function userPrivilege()
    {
        //Fetch user details
//        $fetch = User::where([ ['id', '=', $id], ]);
        $fetch = User::where([
        //    ['id', '=', $id], 
        ])->value('id');
        return $fetch;
    }
}
