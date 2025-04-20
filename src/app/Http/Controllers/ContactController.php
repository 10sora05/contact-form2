<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
 public function index()
    {
        return view('index');
    }

    // フォーム表示
  public function create()
    {
        return view('contact.create');
    }

    // 確認画面表示
  public function confirm(Request $request)
    {
// フォームのバリデーション
    $validated = $request->validate([
        'first_name' => 'required|string|max:255',
        'given_name' => 'required|string|max:255',
        'gender' => 'required|in:1,2,3',
        'email' => 'required|email',
        'tel1' => 'required|numeric|digits_between:2,4',
        'tel2' => 'required|numeric|digits_between:2,4',
        'tel3' => 'required|numeric|digits:4',
        'address' => 'required|string|max:255',
        'building' => 'nullable|string',
        'detail' => 'required|string',
        'content' => 'required|string|max:120',
    ]);

    // セッションにデータを保存
    session([
            'first_name' => $validated['first_name'],
            'given_name' => $validated['given_name'],
            'gender' => $validated['gender'],
            'email' => $validated['email'],
            'tel1' => $validated['tel1'],
            'tel2' => $validated['tel2'],
            'tel3' => $validated['tel3'],
            'address' => $validated['address'],
            'building' => $validated['building'],
            'detail' => $validated['detail'],
            'content' => $validated['content'],
        ]);

        return view('confirm', $validated);
      }
    
    // データベースに保存
  public function store(Request $request)
    {
        // フォームデータが送信されてきたときに、必要なカラムにデータを挿入
        $tel = "{$request->tel1}-{$request->tel2}-{$request->tel3}";

        // first_name と given_name を結合して name に保存
        $full_name = "{$request->first_name}-{$request->given_name}";
        
        // データベースに保存
        Contact::create([
            'name' => $full_name,
            'gender' => $request->gender,
            'email' => $request->email,
            'tel' => $tel,  // 電話番号を統合
            'address' => $request->address,
            'building' => $request->building,
            'detail' => $request->detail,
            'content' => $request->content,
        ]);

        return redirect()->route('thanks');

    }
  public function admin(Request $request)
    {
        $contacts = Contact::paginate(7);

        return view('admin', compact('contacts'));
    }

  public function search(Request $request)
    {
        $query = Contact::query();

        if ($request->filled('keyword')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->keyword . '%')
                  ->orWhere('email', 'like', '%' . $request->keyword . '%');
            });
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('detail')) {
            $query->where('detail', $request->detail);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->paginate(7); // 1ページ7件

        return view('admin', compact('contacts'));
    }
    public function show($id)
{
    $contact = Contact::findOrFail($id);

    // 必要な情報をJSON形式で返す
    return response()->json([
        'name' => $contact->name,
        'gender_label' => $contact->gender === 1 ? '男性' : '女性',
        'email' => $contact->email,
        'content' => $contact->content,
        'tel1' => $contact->tel1,
        'tel2' => $contact->tel2,
        'tel3' => $contact->tel3,
        'address' => $contact->address,
        'building' => $contact->building,
        'detail' => $contact->detail,
    ]);
} 

}