@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="admin-content">
    <h1 class="admin-title">Admin</h1>
    <form action="{{ route('admin.index') }}" method="GET" class="admin-search-form">
    <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="名前やメールアドレスを入力してください">

    <select name="gender">
        <option value="">性別</option>
        <option value="all" {{ request('gender') === 'all' ? 'selected' : '' }}>全て</option>
        <option value="male" {{ request('gender') === 'male' ? 'selected' : '' }}>男性</option>
        <option value="female" {{ request('gender') === 'female' ? 'selected' : '' }}>女性</option>
        <option value="other" {{ request('gender') === 'other' ? 'selected' : '' }}>その他</option>
    </select>

    <select name="category_id">
        <option value="">お問い合わせの種類</option>
        @foreach($categories as $category)
        <option value="{{ $category->id }}" {{ (string)request('category_id') === (string)$category->id ? 'selected' : '' }}>
            {{ $category->name }}
        </option>
        @endforeach
    </select>

    <input type="date" name="date" value="{{ request('date') }}">
    <button type="submit" class="search-btn">検索</button>
    <a href="{{ route('admin.index') }}" class="reset-btn">リセット</a>

    <a href="{{ route('admin.export', request()->query()) }}" class="export-btn" 
    style="background:#4CAF50; color:white; padding:6px 12px; border-radius:5px; text-decoration:none;">
        エクスポート
    </a>
</form>

<table class="admin-table">
    <thead>
        <tr>
            <th>お名前</th>
            <th>性別</th>
            <th>メールアドレス</th>
            <th>お問い合わせの種類</th>
            <th></th> {{-- 詳細ボタン用カラム --}}
        </tr>
    </thead>
    <tbody>
        @forelse ($contacts as $contact)
        <tr>
            <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
            <td>{{ $contact->gender }}</td>
            <td>{{ $contact->email }}</td>
            <td>{{ $contact->category->name ?? '未分類' }}</td>
            <td>
                <button class="detail-btn" data-id="{{ $contact->id }}">詳細</button>
            </td>
        </tr>
        @empty
        <tr><td colspan="5">データがありません</td></tr>
        @endforelse
    </tbody>
</table>

{{-- モーダル --}}
<div id="detail-modal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="modal-close">&times;</span>
        <div id="detail-content"></div>

        <button id="delete-btn" style="background-color:#d9534f; color:white; padding:8px 16px; border:none; border-radius:5px; cursor:pointer;">
            削除
        </button>
    </div>
</div>


<div class="pagination-wrapper">
    {{ $contacts->links() }}
</div>

<script>
let currentId = null;

document.querySelectorAll('.detail-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        currentId = btn.dataset.id;

        fetch(`/admin/contacts/${currentId}`)
            .then(res => res.json())
            .then(data => {
                document.getElementById('detail-content').innerHTML = `
                    <p><strong>名前：</strong>${data.name}</p>
                    <p><strong>性別：</strong>${data.gender}</p>
                    <p><strong>メールアドレス：</strong>${data.email}</p>
                    <p><strong>電話番号：</strong>${data.phone}</p>
                    <p><strong>住所：</strong>${data.address}</p>
                    <p><strong>建物名：</strong>${data.building}</p>
                    <p><strong>お問い合わせの種類：</strong>${data.category}</p>
                    <p><strong>内容：</strong><br>${data.content}</p>
                `;
                document.getElementById('detail-modal').style.display = 'flex';
            })
            .catch(() => alert('詳細情報の取得に失敗しました。'));
    });
});

// モーダル閉じる処理
document.querySelector('.modal-close').addEventListener('click', () => {
    document.getElementById('detail-modal').style.display = 'none';
});

// 削除ボタン押下処理
document.getElementById('delete-btn').addEventListener('click', () => {
    if (!currentId) return;
    if (!confirm('本当に削除しますか？')) return;

    fetch(`/admin/contacts/${currentId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
        },
    })
    .then(res => {
        if (!res.ok) throw new Error('削除失敗');
        return res.json();
    })
    .then(() => {
        alert('削除しました');
        document.getElementById('detail-modal').style.display = 'none';
        location.reload(); // ページ再読み込みして一覧を更新
    })
    .catch(() => alert('削除に失敗しました'));
});
</script>
@endsection
