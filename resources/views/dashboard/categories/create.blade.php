@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Add New Item</h1>
</div>

<div class="col-lg-8">
    <form action="/dashboard/categories" method="POST" enctype="multipart/form-data">
        {{-- karena udh pake route resource, jadi klo ada action ke posts methodnya POST, 
        langsung masuk ke method store di dashboardcontroller --}}

        {{-- ectype dipake biar formnya bisa ngambil input file --}}
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label">name</label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" 
          id="name" name="name" value="{{ old('name') }}" required autofocus>
          @error('name')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="slug" class="form-label">slug</label>
          <input type="text" class="form-control @error('slug') is-invalid @enderror" 
          id="slug" name="slug" value="{{ old('slug') }}" required>
          @error('slug')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <button type="submit" class="btn btn-dark mb-5">Create</button>
      </form>
</div>

{{-- <script>
  const title = document.querySelector('#title');
  const slug = document.querySelector('#slug');
  // queryselector ambil referensi dari id sebuah tag

  title.addEventListener('change', function(){
    fetch('/dashboard/posts/checkSlug?title=' + title.value)
    .then(response => response.json())
    .then(data => slug.value = data.slug)
  });

  document.addEventListener('trix-file-accept', function(e){
    e.preventDefault(); 
  })

  // preview gambar
  function previewImage(){
    const image = document.querySelector('#image');
    const imgPreview = document.querySelector('.img-preview');

    imgPreview.style.display = 'block';

    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);

    oFReader.onload = function(oFREvent){
      imgPreview.src = oFREvent.target.result;
    }
  }

</script> --}}

@endsection