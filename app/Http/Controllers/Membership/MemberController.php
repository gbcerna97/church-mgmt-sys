<?php

namespace App\Http\Controllers\Membership;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Member::latest()->paginate(10);
        return view('members.index',compact('members'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('members.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'member_name' => 'required',
            'nickname'=> 'required',
            'sex'=>'required',
            'age' => 'required',
            'birthday' => 'required',
            'contact_number' => 'required',
            'occupation' => 'required',
            'address' => 'required',
            'email_add'=>'required'
        ]);

        Member::create($request->all());

        return redirect()->route('members.index')->with('success','Member Added Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        return view('members.show',compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        return view('members.edit')
            ->with(compact('member'));
    }

    /**
     * Update the specified resource in storage.events
     */
    public function update(Request $request, Member $member)
    {
        $request->validate([
            'member_name' => 'required',
            'nickname'=> 'required',
            'sex'=>'required',
            'age' => 'required',
            'birthday' => 'required',
            'contact_number' => 'required',
            'occupation' => 'required',
            'address' => 'required',
            'email_add'=>'required'
        ]);

        $member->update($request->all());

        return redirect()->route('members.index')->with('success','Member Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        $member->delete();

        return redirect()->route('members.index')->with('success','Member deleted successfully');
    }


}