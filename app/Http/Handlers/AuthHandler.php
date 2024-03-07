<?php

namespace App\Http\Handlers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Image;
use App\Models\PermissionGroups;
use App\Models\PermissionLinks;
use App\Models\PermissionItems;

class AuthHandler
{
    public static function getAccessDetails($request) {
        $location = Http::acceptJson()->get('http://ip-api.com/json/'.$request->ip().'');

        if($location->json('status') == 'fail') {
            $location = 'Localização do acesso Indeterminada.';
        } else {
            $location  = 'Localização aproximada: '.$location->json('city').' - '.$location->json('regionName').' '.$location->json('countryCode').' no dia '.date('d/m/Y \á\s\ H:m', strtotime(Carbon::now())).'';
        }

        return $accessDetails = 'Acessado de um '.$request->header('sec-ch-ua-platform').', endereço IP '.$request->getClientIp().'. '.$location.'';
    }

    public static function getAuthUser() {
        //GETTING THE LOGGEDUSER
        $authUser = Auth::user();

        //GETTING USER PERMISSION IMAGE
        $authUser['image'] = $authUser->getImage->name;

        //GETTING USER PERMISSION
        $authUser['permission'] = $authUser->permission;

        //GETTING USER PERMISSION ITEMS
        $permissionItemsIds = array();

        foreach (PermissionLinks::where('permission_group_id', $authUser['permission']['id'])->get() as $item) {
            $permissionItemsIds[] = $item['permission_item_id'];
        }

        $permissionItemsSlugs = array();
        foreach (PermissionItems::whereIn('id', $permissionItemsIds)->get() as $item) {
            $permissionItemsSlugs[] = $item['slug'];
        }

        $authUser['permissionSlugs'] = $permissionItemsSlugs;

        //GETTING USER PERMISSION NAME
        $authUser['permissionName'] = $authUser->permission['name'];

        return $authUser;
    }
}
