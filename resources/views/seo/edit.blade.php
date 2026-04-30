@extends('include.layout')
@section('content')
    <h2 class="mb-4">{{ $pageName }}</h2>
    <form method="POST" action="{{ route('admin.seo-plugin.update', ['type' => $type, 'id' => $data->id]) }}">
        @csrf
        <div class="row">
            <div class="col-xl-8">

                <div class="card mb-3 p-3">
                    <h4>Basic SEO</h4>
                    <input type="text" name="meta_title" class="form-control mb-2"
                        value="{{ old('meta_title') ?? ($data->seo->meta_title ?? '') }}" maxlength="60"
                        placeholder="Meta Title (60)">
                    <small id="titleCount"></small>
                    <textarea name="meta_description" class="form-control mb-2" maxlength="160" placeholder="Meta Description (160)">{{ old('meta_description') ?? ($data->seo->meta_description ?? '') }}</textarea>
                    <small id="descCount"></small>
                    <textarea name="meta_keywords" class="form-control" placeholder="Meta Keywords">{{ old('meta_keywords') ?? ($data->seo->meta_keywords ?? '') }}</textarea>
                </div>

                <div class="card mb-3 p-3">
                    <h4>Advanced SEO</h4>
                    <input type="text" name="canonical_tag" class="form-control"
                        value="{{ old('canonical_tag') ?? ($data->seo->canonical_tag ?? '') }}">
                    <select name="meta_robots" class="form-control">
                        <option value="index,follow">Index, Follow</option>
                        <option value="noindex,nofollow">No Index, No Follow</option>
                    </select>
                    <input type="text" name="meta_author" class="form-control"
                        value="{{ old('meta_author') ?? ($data->seo->meta_author ?? '') }}">
                </div>
                <div class="card mb-3 p-3">
                    <h4>Open Graph (Facebook)</h4>
                    <input type="text" name="og_title" placeholder="OG Title" class="form-control mb-2"
                        value="{{ old('og_title') ?? ($data->seo->og_title ?? '') }}">
                    <textarea name="og_description" class="form-control mb-2" placeholder="OG Description">{{ old('og_description') ?? ($data->seo->og_description ?? '') }}</textarea>
                    <input type="text" name="og_image" class="form-control mb-2" placeholder="Image URL"
                        value="{{ old('og_image') ?? ($data->seo->og_image ?? '') }}">
                    <input type="text" name="og_url" class="form-control" placeholder="URL"
                        value="{{ old('og_url') ?? ($data->seo->og_url ?? '') }}">
                </div>

                <div class="card mb-3 p-3">
                    <h4>Twitter SEO</h4>
                    <input type="text" name="twitter_title" class="form-control mb-2"
                        value="{{ old('twitter_title') ?? ($data->seo->twitter_title ?? '') }}">
                    <textarea name="twitter_description" class="form-control mb-2">{{ old('twitter_description') ?? ($data->seo->twitter_description ?? '') }}</textarea>
                    <input type="text" name="twitter_image" class="form-control"
                        value="{{ old('twitter_image') ?? ($data->seo->twitter_image ?? '') }}">
                </div>

                <div class="card mb-3 p-3">
                    <h4>Schema (JSON-LD)</h4>
                    <textarea name="schema" class="form-control" rows="5">{{ old('schema') ?? ($data->seo->schema ?? '') }}</textarea>
                </div>

                <div class="card mb-3">
                    <div class="card-body" style="text-align: right">
                        <a href="{{ route('admin.seo-plugin.index', $type) }}" class="btn btn-secondary btn-sm">Cancel</a>
                        <button class="btn btn-success btn-sm" type="submit">Update</button>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card p-3 mb-3">
                    <h5>Google Preview</h5>
                    <p id="preview-url" style="color:green;">
                        {{ url('/') }}/{{ old('slug') ?? ($data->seo->slug ?? '') }}
                    </p>
                    <h6 id="preview-title" style="color:#1a0dab;">
                        {{ old('meta_title') ?? ($data->seo->meta_title ?? 'Meta Title') }}
                    </h6>
                    <p id="preview-desc">
                        {{ old('meta_description') ?? ($data->seo->meta_description ?? 'Meta description...') }}
                    </p>
                </div>
                <div class="card p-3">
                    <h5>SEO Score</h5>
                    <p id="seoScore">0%</p>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('script')
    <script>
        let titleInput = document.querySelector('[name="meta_title"]');
        let descInput = document.querySelector('[name="meta_description"]');
        let slugInput = document.querySelector('[name="slug"]');

        titleInput.addEventListener('input', function() {
            document.getElementById('preview-title').innerText = this.value;
            document.getElementById('titleCount').innerText = this.value.length + "/60";
            calculateScore();
        });

        descInput.addEventListener('input', function() {
            document.getElementById('preview-desc').innerText = this.value;
            document.getElementById('descCount').innerText = this.value.length + "/160";
            calculateScore();
        });

        slugInput.addEventListener('input', function() {
            document.getElementById('preview-url').innerText = window.location.origin + '/' + this.value;
        });

        function calculateScore() {
            let score = 0;

            if (titleInput.value.length >= 50 && titleInput.value.length <= 60) score += 40;
            if (descInput.value.length >= 120 && descInput.value.length <= 160) score += 40;
            if (slugInput.value) score += 20;

            document.getElementById('seoScore').innerText = score + "%";
        }
    </script>
@endsection
