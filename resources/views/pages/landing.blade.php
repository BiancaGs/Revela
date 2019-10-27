@extends('layouts.landing')

@section('title', 'Landing')

@section('content')

    <article id="main-section">

        @include('includes.navbar')

        <section id="hero-section">
    
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <h2>Tenha todas as suas fotos na palma da sua mão. Literalmente.</h2>
                        <p>Revela é a plataforma que te ajuda a liberar espaço no seu celular, colocando-as em um álbum digital todo mês.</p>
                        <a class="cta-home mt-3" href="#!">
                            <span class="content">Começar agora</span>
                            <span class="icon"><i class="fa fa-arrow-right" aria-hidden="true"></i></span>
                        </a>
                    </div>
                </div>
            </div>
    
        </section>
    
        <section id="albums-section">
    
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <h2>Receba um álbum personalizado todo mês com seus momentos mais importantes.</h2>
                        <p>Garantimos álbuns personalizados todo mês de acordo com as estações do ano, eventos e festividades.</p>
                    </div>
                </div>
            </div>
    
        </section>

    </article>


@endsection
