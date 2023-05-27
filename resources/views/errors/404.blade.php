@extends('components.header')
<style>
    #header.header{
        opacity: 0;
    }
    #main, #footer{
        margin: 0 !important
    }
    .header .toggle-sidebar-btn{
        display: none;
    }
</style>
<main>
    <div class="container">
      <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
        <h1>404</h1>
        <h2>Rất tiếc trang không tìm thấy.</h2>
        <a class="btn" href="/">Đi đến dashboard</a>
        <img src="assets/img/not-found.svg" class="img-fluid py-5" alt="Page Not Found">
      </section>
    </div>
  </main>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  
  @extends('components.footer')