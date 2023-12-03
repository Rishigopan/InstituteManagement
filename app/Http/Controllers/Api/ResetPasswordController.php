<?php

namespace App\Http\Controllers\Api;
use App\Models\User;
use App\Http\Resources\ResetPasswordResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class ResetPasswordController extends Controller
{
    public function reset(Request $request, $id)
    {
        $user = User::find($id);
        
        $oldPassword = $request->input('old_password');
        $newPassword = $request->input('new_password');
        $confirmPassword = $request->input('confirm_password');

        
        if (Hash::check($oldPassword, $user->password)) {
            
            if (Hash::check($newPassword, Hash::make($confirmPassword))) {
                $user->password = Hash::make($newPassword);
                $user->save();
            
            return response()->json([
                'success' => true,
                'code'=>'1',
                'message' => 'Password updated successfully.'
            ]);

            }
            else {
                return response()->json([
                    'success' => true,
                    'code'=>'2',
                    'message' => 'Confirm Password Not Match'
                ]);
            }

            
        } else {
            return response()->json([
                'success' => true,
                'code'=>'0',
                'message' => 'Incorrect old password.'
            ]);
        }
    }
}
