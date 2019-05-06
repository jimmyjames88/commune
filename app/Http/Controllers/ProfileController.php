<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class ProfileController extends Controller
{
    public function index(){

    }

    public function show($id) {
        $user = \App\User::find($id);
        $user->posts = $user->posts()->with(['likes', 'comments', 'user.profile'])->latest()->get();
        return view('profiles.show', compact('user'));
    }

    public function edit($id) {
        $profile = \App\Profile::where('user_id', $id)->first();
        return view('profiles.edit', compact('profile'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'avatar'    =>  'image|mimes:jpeg,jpg,png,gif|max:2048'
        ]);

        $profile = \App\Profile::where('user_id', $id)->first();

        foreach($request->except(['_method', '_token', 'avatar']) as $k=>$v) {
            $profile->$k = $v;
        }

        // avatar upload
        if($request->file('avatar')) {
            $image = $request->file('avatar');
            $new_name = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path("images/avatars/" . $id), $new_name);
            $profile->avatar = $new_name;
        } else {
            $profile->avatar = null;
        }

        if($profile->save()) {
            return redirect('/profiles/' . $profile->user_id);
        }

        dd('Unspecified error');

    }

    public function follow(Request $request, $leader_id) {
        $follow = DB::table('followers')->insert([
            'leader_id'     =>  $leader_id,
            'follower_id'   =>  Auth::id()
        ]);

        if($follow) {
            $user = \App\User::find($leader_id);
            $request->session()->flash('message', 'You are now following ' . $user->name);
            return redirect(url()->previous());
        }
        dd('Unspecified error');
    }

    public function unfollow(Request $request, $leader_id) {
        $delete = DB::table('followers')->where([
            ['leader_id', $leader_id],
            ['follower_id', Auth::id()]
        ])->delete();

        if($delete){
            $user = \App\User::find($leader_id);
            $request->session()->flash('message', 'You are no longer following ' . $user->name);
            return redirect(url()->previous());
        }
        dd('Unspecified error');
    }

    public function followers($id) {
        $user = \App\User::with('followers')->find($id);
        return view('profiles.followers', compact('user'));
    }

    public function following($id) {
        $user = \App\User::with('following')->find($id);
        return view('profiles.following', compact('user'));
    }

    public function currentUser() {

    }

    public function suggest() {
        // get an array of ID's of people user already follows
        $following = Auth::user()->following->pluck('id')->toArray();

        // add current user to following list so they aren't suggested
        // to follow themselves
        array_push($following, Auth::id());

        $suggested = \App\User::whereNotIn('id', $following)->inRandomOrder()->limit(10)->get();
        return view('profiles.suggested', ['users' => $suggested]);
    }
}
