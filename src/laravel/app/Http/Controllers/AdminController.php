<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Models\User;
use App\Http\Requests\RegisterRequest;

class AdminController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function index(Request $request)
    {
        $contacts = Contact::with('category')
            ->keywordSearch($request->keyword)
            ->genderSearch($request->gender)
            ->categorySearch($request->category_id)
            ->paginate(7);

    $categories = Category::all();

    $detail = null;
    if ($request->id) {
        $detail = Contact::with('category')->find($request->id);
    }

    return view('admin', compact('contacts', 'categories','detail'));

    }

    public function search(Request $request)
    {
        $contacts = Contact::with('category')
            ->keywordSearch($request->keyword, $request->match_type)
            ->genderSearch($request->gender)
            ->categorySearch($request->category_id)
            ->dateSearch($request->date)
            ->paginate(7);

        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }



    public function export(Request $request)
    {
        $contacts = Contact::with('category')
            ->keywordSearch($request->keyword)
            ->genderSearch($request->gender)
            ->categorySearch($request->category_id)
            ->dateSearch($request->date)
            ->get();

        $csvFileName = 'contacts_' . date('YmdHis') . '.csv';
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$csvFileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];


        $callback = function() use ($contacts) {
        $file = fopen('php://output', 'w');

            fputs($file, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF));

            fputcsv($file, ['お名前', '性別', 'メールアドレス', 'お問い合わせの種類', 'お問い合わせ内容']);

            foreach ($contacts as $contact) {
                $gender = $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他');
                    fputcsv($file, [
                        $contact->last_name . ' ' . $contact->first_name,
                        $gender,
                        $contact->email,
                        $contact->category->content ?? '',
                        $contact->detail
                    ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}

