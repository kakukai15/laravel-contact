<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $validated = $request->validated();
        //dd($validated);

        $category = Category::find($validated['category_id']);
        $validated['category_name'] = $category ? $category->name : '未選択';

        $tel1 = $validated['tel1'] ?? null;
        $tel2 = $validated['tel2'] ?? null;
        $tel3 = $validated['tel3'] ?? null;

        $validated['tel'] = $validated['tel1'] . '-' . $validated['tel2'] . '-' . $validated['tel3'];


        return view('confirm', ['contact' => $validated]);
    }

    public function send(Request $request)
    {
        return redirect()->route('contacts.thanks');
    }

    public function thanks()
    {
        return view('thanks');
    }
}
