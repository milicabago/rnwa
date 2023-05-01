<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::all();
    
        return view('jobs.index')->with('jobs', $jobs);

    }
     
    public function create()
    {
        return view('jobs.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'job_id' => 'required',
            'job_title' => 'required',
            'min_salary' => 'required|numeric|min:0',
            'max_salary' => [
                'required',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value < $request->min_salary) {
                        $fail('Minimum salary cannot be greater or equal to maximum salary!');
                    }
                }
            ],
        ]);
    
        Job::create($request->all());
    
        return redirect()->route('jobs.index')
            ->with('success','Job created successfully.');
    }
     
    public function show(Job $job)
    {
        return view('jobs.show', compact('job'));
    } 
     
    public function edit(Job $job)
    {
        return view('jobs.edit', compact('job'));
    }
    
    public function update(Request $request, Job $job)
    {
        $request->validate([
            'job_id' => 'required',
            'job_title' => 'required',
            'min_salary' => 'required|numeric|min:0',
            'max_salary' => [
                'required',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value < $request->min_salary) {
                        $fail('Minimum salary cannot be greater or equal to maximum salary!');
                    }
                }
            ],
        ]);
    
        $job->update($request->all());
    
        return redirect()->route('jobs.index')
            ->with('success','Job updated successfully');
    }
    
    public function destroy(Job $job)
    {
        $job->delete();
    
        return redirect()->route('jobs.index')
                        ->with('success','Job deleted successfully');
    }
}