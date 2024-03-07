<?php

namespace App\Http\Handlers;
use App\Models\User;

class UserHandler {
    public static function processUsersListInfo($usersList, $permissionGroups) {
        //CHANGE PERMISSION ID FOR TEXT
        $users = [];
        foreach ($usersList as $user) {
            foreach ($permissionGroups as $permission) {
                if($user['permission_id'] == $permission['id']) {
                    $user['permissionName'] = $permission['name'];
                }
            }

            if(! $user['image']) {
                $user['image'] = User::find($user['id'])->getImage->name;
            }

            $users[] = $user;
        }
        return $users;
    }

    public static function processUserInfo($user, $permissionGroups) {
        //CHANGE PERMISSION ID FOR TEXT
        foreach ($permissionGroups as $permission) {
            if($user->permission_id == $permission->id) {
                $user->permissionName = $permission->name;
            }
        }

        if(! $user->image) {
            $user->image = User::find($user['id'])->getImage->name;
        }

        return $user;
    }

    public static function clientExists($email) {
        if($email) {
            $user = User::where('email', $email)->first();

            return $user;
        }
    }
}



