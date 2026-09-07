<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Katalog Buku &amp; Referensi Kuliah - KEPL</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --bg: #f8fafc;
            --surface: #ffffff;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --success: #16a34a;
            --warning: #d97706;
            --danger: #dc2626;
            --radius: 12px;
            --shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: var(--bg);
            color: var(--text-main);
            line-height: 1.5;
            padding: 2.5rem 1rem;
        }

        .container {
            max-width: 960px;
            margin: 0 auto;
        }

        header {
            margin-bottom: 2rem;
        }

        h1 {
            font-size: 1.875rem;
            font-weight: 700;
            color: var(--text-main);
            letter-spacing: -0.02em;
        }

        .subtitle {
            color: var(--text-muted);
            font-size: 0.95rem;
            margin-top: 0.25rem;
        }

        /* Stat Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.25rem 1.5rem;
            box-shadow: var(--shadow);
        }

        .stat-label {
            font-size: 0.825rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-muted);
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            margin-top: 0.25rem;
            color: var(--text-main);
        }

        .stat-card.avail .stat-value { color: var(--success); }
        .stat-card.borrowed .stat-value { color: var(--warning); }

        /* Card container */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.75rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
        }

        .card-title {
            font-size: 1.15rem;
            font-weight: 600;
            margin-bottom: 1.25rem;
            color: var(--text-main);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* Form */
        .form-grid {
            display: grid;
            grid-template-columns: 2fr 1.5fr 1fr 1.5fr auto;
            gap: 0.75rem;
            align-items: end;
        }

        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
        }

        .form-group label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-muted);
            margin-bottom: 0.35rem;
        }

        input[type="text"], input[type="number"], select {
            width: 100%;
            padding: 0.6rem 0.75rem;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 0.9rem;
            outline: none;
            transition: border-color 0.15s;
        }

        input[type="text"]:focus, input[type="number"]:focus, select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.6rem 1rem;
            font-size: 0.875rem;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            border: none;
            transition: all 0.15s;
            white-space: nowrap;
        }

        .btn-primary { background: var(--primary); color: #fff; }
        .btn-primary:hover { background: var(--primary-hover); }

        .btn-success { background: var(--success); color: #fff; }
        .btn-success:hover { background: #15803d; }

        .btn-outline { background: transparent; border: 1px solid var(--border); color: var(--text-main); }
        .btn-outline:hover { background: #f1f5f9; }

        /* Alert */
        .alert {
            padding: 0.85rem 1.25rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }
        .alert-success { background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; }
        .alert-danger { background: #fef2f2; border: 1px solid #fecaca; color: var(--danger); }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
        }

        th {
            text-align: left;
            padding: 0.75rem 0.5rem;
            font-size: 0.775rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-muted);
            border-bottom: 2px solid var(--border);
        }

        td {
            padding: 0.85rem 0.5rem;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }

        .badge {
            display: inline-block;
            padding: 0.25rem 0.6rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-kategori { background: #eff6ff; color: #1d4ed8; }
        .badge-tersedia { background: #dcfce7; color: #15803d; }
        .badge-dipinjam { background: #fef3c7; color: #92400e; }

        .borrow-inline {
            display: flex;
            gap: 0.5rem;
        }

        .borrow-inline input {
            padding: 0.35rem 0.5rem;
            font-size: 0.8rem;
            width: 130px;
        }

        .empty-state {
            text-align: center;
            padding: 2.5rem 1rem;
            color: var(--text-muted);
        }

        footer {
            margin-top: 3rem;
            text-align: center;
            font-size: 0.85rem;
            color: var(--text-muted);
            border-top: 1px solid var(--border);
            padding-top: 1.5rem;
        }
    </style>
</head>
<body>
<div class="container">
    <header>
        <h1>Katalog Buku &amp; Referensi Kuliah</h1>
        <p class="subtitle">Sistem inventaris dan peminjaman buku mata kuliah &bull; <strong>evolusi-pl-24-543329-SV-25192</strong></p>
    </header>

    <!-- Stats -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-label">Total Buku</div>
            <div class="stat-value" id="stat-total">{{ $stats['total'] }}</div>
        </div>
        <div class="stat-card avail">
            <div class="stat-label">Tersedia</div>
            <div class="stat-value" id="stat-tersedia">{{ $stats['tersedia'] }}</div>
        </div>
        <div class="stat-card borrowed">
            <div class="stat-label">Sedang Dipinjam</div>
            <div class="stat-value" id="stat-dipinjam">{{ $stats['dipinjam'] }}</div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul style="padding-left: 1.25rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form Tambah -->
    <div class="card">
        <div class="card-title">Tambah Buku Referensi Baru</div>
        <form method="POST" action="{{ route('books.store') }}">
            @csrf
            <div class="form-grid">
                <div class="form-group">
                    <label for="judul">Judul Buku</label>
                    <input type="text" id="judul" name="judul" value="{{ old('judul') }}" placeholder="Contoh: Clean Code" required>
                </div>
                <div class="form-group">
                    <label for="penulis">Penulis</label>
                    <input type="text" id="penulis" name="penulis" value="{{ old('penulis') }}" placeholder="Robert C. Martin" required>
                </div>
                <div class="form-group">
                    <label for="tahun">Tahun</label>
                    <input type="number" id="tahun" name="tahun" value="{{ old('tahun', date('Y')) }}" min="1900" max="{{ date('Y') + 1 }}" required>
                </div>
                <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <select id="kategori" name="kategori" required>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat }}" {{ old('kategori') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary" id="btn-tambah">Tambah Buku</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Table Buku -->
    <div class="card">
        <div class="card-title">
            <span>Daftar Buku Referensi ({{ $books->count() }})</span>
        </div>

        <!-- Filter & Pencarian -->
        <form method="GET" action="{{ route('books.index') }}" style="margin-bottom: 1.5rem; display: flex; gap: 0.75rem; flex-wrap: wrap; align-items: center;">
            <div style="flex: 1; min-width: 200px;">
                <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari judul atau penulis...">
            </div>
            <div style="width: 220px;">
                <select name="kategori">
                    <option value="">-- Semua Kategori --</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat }}" {{ ($kategori ?? '') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary" style="padding: 0.6rem 1rem;">Filter</button>
            @if (!empty($search) || !empty($kategori))
                <a href="{{ route('books.index') }}" class="btn btn-outline" style="padding: 0.6rem 1rem; text-decoration: none;">Reset</a>
            @endif
        </form>

        @if (!empty($search) || !empty($kategori))
            <div style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 1rem;">
                Menampilkan hasil filter
                @if (!empty($search)) untuk kata kunci "<strong>{{ $search }}</strong>"@endif
                @if (!empty($kategori)) pada kategori "<strong>{{ $kategori }}</strong>"@endif
            </div>
        @endif

        @if ($books->isEmpty())
            <div class="empty-state">
                <p>Tidak ada buku yang sesuai dengan filter atau pencarian Anda.</p>
            </div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Judul &amp; Penulis</th>
                        <th>Tahun</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Peminjam</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <td>
                                <strong>{{ $book->judul }}</strong>
                                <div style="font-size: 0.8rem; color: var(--text-muted);">{{ $book->penulis }}</div>
                            </td>
                            <td>{{ $book->tahun }}</td>
                            <td><span class="badge badge-kategori">{{ $book->kategori }}</span></td>
                            <td>
                                @if ($book->isAvailable())
                                    <span class="badge badge-tersedia">Tersedia</span>
                                @else
                                    <span class="badge badge-dipinjam">Dipinjam</span>
                                @endif
                            </td>
                            <td>
                                {{ $book->peminjam ?? '-' }}
                            </td>
                            <td>
                                @if ($book->isAvailable())
                                    <form method="POST" action="{{ route('books.borrow', $book) }}" class="borrow-inline">
                                        @csrf
                                        <input type="text" name="peminjam" placeholder="Nama Peminjam" required>
                                        <button type="submit" class="btn btn-primary" style="padding: 0.35rem 0.65rem; font-size: 0.8rem;">Pinjam</button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('books.return', $book) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-success" style="padding: 0.35rem 0.65rem; font-size: 0.8rem;">Kembalikan</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <footer>
        <p>&copy; 2026 - Repositori Tugas KEPL Pertemuan 1 &bull; <strong>evolusi-pl-24-543329-SV-25192</strong></p>
    </footer>
</div>
</body>
</html>
