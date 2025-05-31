<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function toggleStatus(Request $request, User $user)
    {
        try {
            $status = $request->input('status');
            $user->status = ($status === '1' || $status === 1 || $status === true || $status === 'true');
            $user->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Status updated successfully'
            ]);
        } catch (Exception $e) {
            Log::error('Error toggling user status: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to update status'
            ], 500);
        }
    }

    public function toggleCodBlock(Request $request, User $user)
    {
        try {
            $codBlock = $request->input('cod_block');
            $user->cod_block = ($codBlock === '1' || $codBlock === 1 || $codBlock === true || $codBlock === 'true');
            $user->save();
            
            return response()->json([
                'success' => true,
                'message' => 'COD Block status updated successfully'
            ]);
        } catch (Exception $e) {
            Log::error('Error toggling user COD block: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to update COD block status',
                'title' => 'Error!'
            ]);
        }
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('admin.users.index')
                ->with('success', ['message' => 'User deleted successfully', 'title' => 'Success!']);
        } catch (Exception $e) {
            Log::error('Error deleting user: ' . $e->getMessage());
            return redirect()->route('admin.users.index')
                ->with('error', ['message' => 'Failed to delete user', 'title' => 'Error!']);
        }
    }

    public function export($type)
    {
        $users = User::all();
        $filename = 'users-' . date('Y-m-d') . '.' . $type;
        
        if ($type === 'csv') {
            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ];
            
            $output = fopen('php://temp', 'w+');
            
            // Add UTF-8 BOM for Excel
            fputs($output, "\xEF\xBB\xBF");
            
            // Add headers
            fputcsv($output, [
                'User Name',
                'Mobile Number',
                'Email',
                'Status',
                'COD Block',
                'Created At'
            ]);
            
            // Add data rows
            foreach ($users as $user) {
                fputcsv($output, [
                    $user->full_name,
                    $user->phone,
                    $user->email,
                    $user->status ? 'Active' : 'Inactive',
                    $user->cod_block ? 'Yes' : 'No',
                    $user->created_at->format('M d, Y H:i')
                ]);
            }
            
            rewind($output);
            $content = stream_get_contents($output);
            fclose($output);
            
            return response($content, 200, $headers);
        } elseif ($type === 'pdf') {
            $data = [];
            foreach ($users as $user) {
                $data[] = [
                    'User Name' => $user->full_name,
                    'Mobile Number' => $user->phone,
                    'Email' => $user->email,
                    'Status' => $user->status ? 'Active' : 'Inactive',
                    'COD Block' => $user->cod_block ? 'Yes' : 'No',
                    'Created At' => $user->created_at->format('M d, Y H:i')
                ];
            }
            
            $pdf = Pdf::loadView('admin.users.export-pdf', compact('data'));
            return $pdf->download($filename);
        } elseif ($type === 'xlsx' || $type === 'xls') {
            // For Excel, we'll use CSV with .xls extension
            $headers = [
                'Content-Type' => 'application/vnd.ms-excel',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ];
            
            $output = fopen('php://temp', 'w+');
            
            // Add UTF-8 BOM for Excel
            fputs($output, "\xEF\xBB\xBF");
            
            // Add headers
            fputcsv($output, [
                'User Name',
                'Mobile Number',
                'Email',
                'Status',
                'COD Block',
                'Created At'
            ]);
            
            // Add data rows
            foreach ($users as $user) {
                fputcsv($output, [
                    $user->full_name,
                    $user->phone,
                    $user->email,
                    $user->status ? 'Active' : 'Inactive',
                    $user->cod_block ? 'Yes' : 'No',
                    $user->created_at->format('M d, Y H:i')
                ]);
            }
            
            rewind($output);
            $content = stream_get_contents($output);
            fclose($output);
            
            return response($content, 200, $headers);
        }
        
        return redirect()->route('admin.users.index')
            ->with('error', ['message' => 'Invalid export type', 'title' => 'Error!']);
    }
}
