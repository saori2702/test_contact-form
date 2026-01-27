<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('contact', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        if ($request->has('back')) {

        return redirect('/')->withInput();
        }

        $contact = $request->only([
            'first_name',
            'last_name',
            'gender',
            'email',
            'tel_1','tel_2','tel_3',
            'address',
            'building',
            'contact',
            'categories_id',
        ]);

        $contact['tel'] = $contact['tel_1'] . $contact['tel_2'] . $contact['tel_3'];

        $category = Category::find($contact['categories_id']);

        $contact['category_content'] = $category->content;

        $gender_map = [
        '1' => '男性',
        '2' => '女性',
        '3' => 'その他',
        ];

        $contact['gender_label'] = $gender_map[$contact['gender']] ?? '';

        return view('confirm', compact('contact'));
    }

    public function store(Request $request)
    {
        if($request->input('back')){
        return redirect('/')->withInput();
        }

        Contact::create([
        'last_name'   => $request->last_name,
        'first_name'  => $request->first_name,
        'gender'      => $request->gender,
        'email'       => $request->email,
        'tel'         => $request->tel_1 . $request->tel_2 . $request->tel_3, // 合体！
        'address'     => $request->address,
        'building'    => $request->building,
        'category_id' => $request->category_id,
        'detail'      => $request->contact, //contactをdetailとして保存
        ]);

        return view('thanks');
    }

    public function destroy(Request $request)
    {
        $id=$request->id;
        Contact::findOrFail($id)->delete();
        return redirect('/admin');
    }
}
