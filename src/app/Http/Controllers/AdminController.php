<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::query();
        $query = $this->applyFilters($query, $request);

        $contacts = $query->paginate(7)->withQueryString();
        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }

    public function export(Request $request)
    {
        $query = Contact::query();
        $query = $this->applyFilters($query, $request);

        $contacts = $query->get();
        $filename = 'contacts_' . now()->format('Ymd_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ];

        $callback = function () use ($contacts) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['ID', '名前', 'メール', '性別', 'お問い合わせ種類', '内容', '作成日']);

            foreach ($contacts as $contact) {
                fputcsv($handle, [
                    $contact->id,
                    $contact->last_name . ' ' . $contact->first_name,
                    $contact->email,
                    $contact->gender,
                    $contact->category->name ?? '',
                    $contact->content,
                    $contact->created_at->format('Y-m-d H:i'),
                ]);
            }
            fclose($handle);
        };

        return response()->streamDownload($callback, $filename, $headers);
    }

    public function show($id)
    {
        $contact = Contact::with('category')->findOrFail($id);

        return response()->json([
            'name' => $contact->last_name . ' ' . $contact->first_name,
            'email' => $contact->email,
            'gender' => $contact->gender,
            'category' => $contact->category->name ?? '未分類',
            'content' => $contact->content,
            'address' => $contact->address ?? '',
            'building' => $contact->building ?? '',
            'phone' => $contact->phone ?? '',
        ]);
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return response()->json(['message' => '削除しました']);
    }

    private function applyFilters($query, Request $request)
    {
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('last_name', 'like', "%{$keyword}%")
                  ->orWhere('first_name', 'like', "%{$keyword}%")
                  ->orWhere('email', 'like', "%{$keyword}%");
            });
        }

        if ($request->filled('gender') && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        return $query;
    }
}
