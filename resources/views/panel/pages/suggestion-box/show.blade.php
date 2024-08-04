@extends('panel.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Detail Pesan Kotak Saran</h4>
                    </div>
                </div>
                <div class="iq-card-body">
                    <div class="form-group">
                        <label for="name">Pesan<span class="text-danger">*</span></label>
                        <p class="border p-3" style="border-radius: 8`px">{{ $suggestionBox->suggestion }}</p>
                    </div>
                    <div class="form-group d-flex justify-content-end" style="gap: 6px">
                        <a href="/panel/suggestion-boxes" class="btn btn-secondary"><i class="las la-undo"></i>Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
