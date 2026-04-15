@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 900px; margin: 30px auto;">
    
    <h2 style="margin-bottom: 20px;">إدارة التصنيفات</h2>

    @if(session('success'))
        <div style="background: #d1fae5; color: #065f46; padding: 12px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div style="background: #fee2e2; color: #991b1b; padding: 12px; border-radius: 8px; margin-bottom: 20px;">
            <ul style="margin: 0; padding-right: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div style="background: #fff; padding: 20px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); margin-bottom: 30px;">
        <form method="POST" action="{{ route('categories.store') }}">
            @csrf

            <div style="margin-bottom: 15px;">
                <label for="name" style="display: block; margin-bottom: 8px;">اسم التصنيف</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 8px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="description" style="display: block; margin-bottom: 8px;">الوصف</label>
                <textarea name="description" id="description" rows="4"
                    style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 8px;">{{ old('description') }}</textarea>
            </div>

            <button type="submit"
                style="background: #e67e22; color: white; border: none; padding: 10px 18px; border-radius: 8px; cursor: pointer;">
                إضافة تصنيف
            </button>
        </form>
    </div>

    <div style="background: #fff; padding: 20px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.08);">
        <h3 style="margin-bottom: 15px;">كل التصنيفات</h3>

        @if($categories->count())
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f3f4f6;">
                        <th style="padding: 12px; border: 1px solid #ddd;">#</th>
                        <th style="padding: 12px; border: 1px solid #ddd;">الاسم</th>
                        <th style="padding: 12px; border: 1px solid #ddd;">الوصف</th>
                        <th style="padding: 12px; border: 1px solid #ddd;">التحكم</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td style="padding: 12px; border: 1px solid #ddd;">{{ $loop->iteration }}</td>
                            <td style="padding: 12px; border: 1px solid #ddd;">{{ $category->name }}</td>
                            <td style="padding: 12px; border: 1px solid #ddd;">{{ $category->description ?? '-' }}</td>
                            <td style="padding: 12px; border: 1px solid #ddd;">
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف التصنيف؟');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        style="background: #dc2626; color: white; border: none; padding: 8px 12px; border-radius: 6px; cursor: pointer;">
                                        حذف
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>لا توجد تصنيفات حتى الآن.</p>
        @endif
    </div>
</div>
@endsection