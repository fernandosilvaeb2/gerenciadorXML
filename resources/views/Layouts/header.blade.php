<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"><i class="fas fa-file-invoice-dollar"></i> Gerenciador NF</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav me-auto mb-2 mb-md-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="link_notas" href="/notas">Notas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="link_clientes" href="/clientes">Clientes</a>
              </li>
          </ul>
          <form class="d-flex">
            <input class="form-control me-2" type="text" placeholder="N° da Nota Fiscal" id="edt_pesquisa" aria-label="Search">
            <a class="btn btn-outline-success" id="bt_pesquisa"> <i class="fa fa-search"></i> </a>
          </form>
        </div>
      </div>
    </nav>
  </header>
