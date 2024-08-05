<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\District;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function pending(Request $request)
    {
        $data = [
            'title' => 'Pengguna',
            'subTitle' => 'Pending',
            'page_id' => null,
            'district' => District::all()
        ];
        return view('pages.user.pending', $data);
    }

    public function pendingData(Request $request) {
        $search = $request->input('q');
        $role = $request->input('role');
        $districtId = $request->input('district');
        $villageId = $request->input('village');

        $query = User::query();

        $query->when($search, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                      ->orWhere('email', 'like', '%' . $search . '%');
            });
        });

        $query->when($districtId, function ($query, $districtId) {
            return $query->where('district_id', $districtId);
        });

        $query->when($villageId, function ($query, $villageId) {
            return $query->where('village_id', $villageId);
        });

        $users = $query->with('district','village')->paginate(10);

        return response()->json($users);
    }
}

