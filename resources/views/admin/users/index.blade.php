@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container admin-shell">
            @include('admin.partials.sidebar')
            <div>
                <h1>Kullanici yonetimi</h1>
                <table>
                    <thead><tr><th>Ad</th><th>E-posta</th><th>Bakiye</th><th>Durum</th><th></th></tr></thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ number_format($user->wallet_balance, 2, ',', '.') }} TL</td>
                                <td>{{ $user->is_active ? 'Aktif' : 'Pasif' }}</td>
                                <td style="display: flex; gap: 8px;">
                                    <form method="post" action="{{ route('admin.users.toggle', $user) }}">
                                        @csrf
                                        <button class="{{ $user->is_active ? 'btn danger' : 'btn' }}" type="submit">{{ $user->is_active ? 'Dondur' : 'Aktif et' }}</button>
                                    </form>
                                    <form method="post" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Kullaniciyi silmek istediginize emin misiniz?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn danger" type="submit">Sil</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
        </div>
    </section>
@endsection
