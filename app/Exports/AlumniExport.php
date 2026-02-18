<?php

namespace App\Exports;

use App\Models\AlumniProfile;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AlumniExport implements FromQuery, WithHeadings, WithMapping
{
    protected $selectedIds;

    public function __construct($selectedIds = null)
    {
        $this->selectedIds = $selectedIds;
    }

    public function query()
    {
        $query = AlumniProfile::query()->with('user');

        if (!empty($this->selectedIds)) {
            $query->whereIn('id', $this->selectedIds);
        }

        return $query;
    }

    /**
     * Tentukan Judul Kolom di Excel
     */
    public function headings(): array
    {
        return [
            'Nama Lengkap',
            'Email',
            'Angkatan',
            'Tahun Lulus',
            'Nomor Telepon',
            'Alamat',
            'Pekerjaan Saat Ini',
            'Nama Perusahaan',
            'Status Verifikasi',
            'Instagram',
            'LinkedIn',
            'Facebook',
            'Twitter',
            'Memiliki Bisnis',
            'Nama Bisnis',
            'Jenis Bisnis',
            'Deskripsi Bisnis',
        ];
    }

    /**
     * Petakan Data dari Database ke Kolom Excel
     */
    public function map($alumni): array
    {
        $links = is_array($alumni->social_media_links) ? $alumni->social_media_links : [];

        return [
            $alumni->full_name,
            $alumni->user->email ?? '-',
            $alumni->angkatan,
            $alumni->graduation_year,
            $alumni->phone_number ?? '-',
            $alumni->address ?? '-',
            $alumni->current_job ?? '-',
            $alumni->company ?? '-',
            $alumni->is_verified ? 'Verified' : 'Pending',
            $links['instagram'] ?? $links['social_instagram'] ?? '-',
            $links['linkedin']  ?? $links['social_linkedin']  ?? '-',
            $links['facebook']  ?? $links['social_facebook']  ?? '-',
            $links['twitter']   ?? $links['social_twitter']   ?? '-',
            $alumni->has_business ? 'Ya' : 'Tidak',
            $alumni->business_name ?? '-',
            $alumni->business_type ?? '-',
            $alumni->business_description ?? '-',
        ];
    }
}
