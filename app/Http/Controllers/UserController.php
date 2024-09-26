<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Role;
use App\Models\User;
use App\Models\UserStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Propaganistas\LaravelPhone\Rules\Phone;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return view("users.index", compact("users"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        $statuses = UserStatus::all();
        $branches = Branch::all();
        $roles = Role::all();

        return view("users.edit", [
            "user" => $user,
            "statuses" => $statuses,
            "branches" => $branches,
            "roles" => $roles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Definieer validatieregels
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => ['required', new Phone('NL', 'BE', 'FR', 'DE')], // Gebruik de Phone regel van de package met NL landcode
            'status' => 'required',
            'branch' => 'required',
        ]);

        // Voer validatie uit en controleer of deze faalt
        if ($validator->fails()) {
            // Debugging: log fouten
            \Log::error('Validation errors: ', $validator->errors()->toArray());

            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::findOrFail($id);

        // Voer vervanging van tekens uit in het telefoonnummer
        $phone = $request->input('phone');

        $updateData = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $phone, // Gebruik het aangepaste telefoonnummer
            'status_id' => $request->status,
            'branch_id' => $request->branch,
            'updated_at' => Carbon::now(),
        ];

        if ($request->role !== null) {
            $updateData['role_id'] = $request->role;
        }

        $user->update($updateData);

        return redirect()->route("users.index")->with('success', 'User successfully updated');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route("users.index")->with("success", "User successfully deleted");
    }
}
