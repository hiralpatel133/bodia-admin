<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class EmailTemplateController extends Controller
{
    public function index()
    {
        try {
            $templates = EmailTemplate::latest()->get();
            return view('admin.email-templates.index', compact('templates'));
        } catch (Exception $e) {
            Log::error('Error fetching email templates: ' . $e->getMessage());
            return back()->with('error', 'Unable to fetch email templates.');
        }
    }

    public function create()
    {
        return view('admin.email-templates.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'subject' => 'required|string|max:255',
                'body' => 'required',
                'status' => 'boolean'
            ]);

            EmailTemplate::create($validated);

            return redirect()->route('admin.email-templates.index')->with('success', 'Email template created successfully.');
        } catch (Exception $e) {
            Log::error('Error creating email template: ' . $e->getMessage());
            return back()->with('error', 'Failed to create email template.')
                ->withInput();
        }
    }

    public function edit(EmailTemplate $emailTemplate)
    {
        return view('admin.email-templates.edit', compact('emailTemplate'));
    }

    public function update(Request $request, EmailTemplate $emailTemplate)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'subject' => 'required|string|max:255',
                'body' => 'required',
                'status' => 'boolean'
            ]);

            $emailTemplate->update($validated);

            return redirect()->route('admin.email-templates.index')->with('success', 'Email template updated successfully.');
        } catch (Exception $e) {
            Log::error('Error updating email template: ' . $e->getMessage());
            return back()->with('error', 'Failed to update email template.')
                ->withInput();
        }
    }

    public function destroy(EmailTemplate $emailTemplate)
    {
        try {
            $emailTemplate->delete();
            return redirect()->route('admin.email-templates.index')->with('success', 'Email template deleted successfully.');
        } catch (Exception $e) {
            Log::error('Error deleting email template: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete email template.');
        }
    }

    public function toggleStatus(EmailTemplate $emailTemplate)
    {
        try {
            $emailTemplate->status = !$emailTemplate->status;
            $emailTemplate->save();
            
            return response()->json([
                'success' => true,
                'status' => $emailTemplate->status,
                'message' => 'Status updated successfully',
                'title' => 'Success!'
            ]);
        } catch (Exception $e) {
            Log::error('Error toggling email template status: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error updating status: ' . $e->getMessage(),
                'title' => 'Error!'
            ], 500);
        }
    }
}
