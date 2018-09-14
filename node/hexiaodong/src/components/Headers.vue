<template>
  <div class="container-fluid bg-dark fixed-top header">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/"><img src="/assets/images/logo.png"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="/lists/1.html">前端开发</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/lists/2.html">后端开发</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/lists/3.html">系统运维</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/lists/4.html">大数据</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/lists/5.html">网站运营</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/lists/6.html">数据库</a>
            </li>
          </ul>
          <!--<form class="form-inline">-->
          <!--<input class="form-control form-control-sm" type="search" placeholder="请输入" aria-label="Search">-->
          <!--</form>-->
          <div class="sign-in">
            <button type="button" class="btn btn-secondary btn-sm col-sm-12" data-toggle="modal"
                    data-target="#login">
              <span class="glyphicon glyphicon-user"> </span> Login
            </button>
          </div>
        </div>
      </nav>
    </div>
  </div>

</template>

<script>
export default {
  name: 'Headers'
}
</script>
