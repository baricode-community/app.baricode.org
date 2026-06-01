<?php

namespace App\Http\Controllers\Web\Certificate;

use App\Http\Controllers\Controller;
use App\Models\Certificate\Certificate;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CertificateController extends Controller
{
    public function myList(Request $request): View
    {
        $user = $request->user();
        $certificates = $user->certificates()
            ->where('is_active', true)
            ->get();

        return view('pages.certificates.my-list', compact('user', 'certificates'));
    }

    public function show(Certificate $certificate): View
    {
        abort_unless($certificate->is_active, 404);

        $holders = $certificate->users()->get();

        return view('pages.certificates.show', compact('certificate', 'holders'));
    }
}
