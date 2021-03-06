@extends('layouts.dashboard')

@section('title', 'Dados Cadastrais')

@section('styles')
    <link href="{{ asset('lib/fileuploader/dist/font/font-fileuploader.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/fileuploader/dist/jquery.fileuploader.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/fileuploader/dist/jquery.fileuploader-theme-avatar.css') }}" rel="stylesheet">
@endsection

@section('dashboard-sidebar')
    @include('dashboard.components.sidebar')    
@endsection

@section('dashboard-content')
    
    <div class="container">
        <div class="d-flex flex-column align-items-start">
            <div class="w-100" id="profile-picture-container">
                @php
                    $enabled = true;
                    $default_avatar = "https://image.flaticon.com/icons/svg/149/149071.svg";
                    @endphp
                <div class="d-flex align-items-center">
                    {{-- Profile Picture --}}
                    <input 
                        type="file" 
                        name="files" 
                        id="profile-picture-input"
                        data-fileuploader-default="{{ $default_avatar }}" 
                        data-fileuploader-files='{{ isset($avatar) ? json_encode(array($avatar)) : '' }}'{{ !$enabled ? ' disabled' : '' }}
                        data-upload-token="{{ csrf_token() }}"
                        data-user-id="{{ Auth::user()->id }}"
                    >
                    {{-- END Profile Picture --}}
                    <div class="ml-4">
                        <h5>{{ Auth::user()->name }}</h5>
                        <h6 class="badge-dark">
                            @if (Auth::user()->subscription)
                                {{ Auth::user()->subscription->plan->name }}
                            @endif    
                        </h6>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{ route('dashboard.editar-dados-cadastrais') }}" class="btn bg-stylish-grey white-text btn-tool edit">Editar cadastro</a>
                </div>
            </div>
            
            <hr class="w-100 mt-4 mb-0">

            <div class="mt-4 w-100">
                <ul class="nav nav-tabs" id="profile-data-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="meus-dados-tab" data-toggle="tab" href="#meus-dados" role="tab" aria-controls="meus-dados"
                        aria-selected="true">Meus Dados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="endereco-tab" data-toggle="tab" href="#endereco" role="tab" aria-controls="endereco"
                        aria-selected="false">Endereço</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="meu-plano-tab" data-toggle="tab" href="#meu-plano" role="tab" aria-controls="meu-plano"
                        aria-selected="false">Meu Plano</a>
                    </li>
                </ul>
                <div class="tab-content card px-4 pb-4" id="profile-data-tab-content">
                    <div class="tab-pane fade show active" id="meus-dados" role="tabpanel" aria-labelledby="meus-dados-tab">
                        <div class="row mt-5">
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Nome</label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Nome" value="{{ Auth::user()->name }}" readonly>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="cpf">CPF</label>
                                    <input type="text" id="cpf" name="cpf" class="form-control" placeholder="999.999.999-99" value="{{ Auth::user()->cpf }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="text" id="email" name="email" class="form-control" placeholder="E-mail" value="{{ Auth::user()->email }}" readonly>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="cellphone">Tel. Celular</label>
                                    <input type="text" id="cellphone" name="cellphone" class="form-control" placeholder="Telefone Celular" value="{{ Auth::user()->cellphone }}" readonly>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="phone">Tel. Residencial</label>
                                    <input type="text" id="phone" name="phone" class="form-control" placeholder="Telefone Celular" value="{{ Auth::user()->phone }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="endereco" role="tabpanel" aria-labelledby="endereco-tab">
                        <div class="row mt-5">
                            <div class="col">
                                <div class="form-group">
                                    <label for="zip_code">CEP</label>
                                    <input type="text" id="zip_code" name="zip_code" class="form-control" placeholder="99999-999" value="{{ Auth::user()->zip_code }}" readonly>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="city">Cidade</label>
                                    <select class="browser-default custom-select" id="city" name="city" disabled>
                                        <option>Cidade</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}" {{ auth()->user()->city ? (auth()->user()->city->name == $city->name ? 'selected' : '') : '' }}>{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
            
                        <div class="form-group">
                            <label for="neighborhood">Bairro</label>
                            <input type="text" class="form-control" id="neighborhood" placeholder="Bairro" name="neighborhood" autocomplete="new" value="{{ Auth::user()->neighborhood }}" readonly>
                        </div>
            
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="street">Rua</label>
                                    <input type="text" class="form-control" id="street" placeholder="Rua" name="street" autocomplete="new" value="{{ Auth::user()->street }}" readonly>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="street_number">Número</label>
                                    <input type="text" class="form-control" id="street_number" placeholder="Nº" name="street_number" autocomplete="new" value="{{ Auth::user()->street_number }}" readonly >
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="street_complement">Complemento</label>
                            <input type="text" class="form-control" id="street_complement" placeholder="Complemento" name="street_complement" autocomplete="new" value="{{ Auth::user()->street_complement }}" readonly>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="meu-plano" role="tabpanel" aria-labelledby="meu-plano-tab">
                        <table class="table table-cadastro mt-5">
                            <thead>
                                <tr class="header">
                                    <th>Plano</th>
                                    <th>Número de Fotos</th>
                                    <th>Preço</th>
                                    <th>Validade</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach ($plans as $plan)
                                    <tr>
                                        <td>{{ $plan->name }}</td>
                                        <td>{{ $plan->number_of_photos }}</td>
                                        <td>R${{ $plan->price }}</td>
                                        <td>
                                            @if (Auth::user()->subscription and $plan->name == Auth::user()->subscription->plan->name)
                                                {{ date('d/m/Y H:i', strtotime(Auth::user()->subscription->subscription_end)) }}
                                            @endif
                                        </td>
                                        <td>
                                            @if (Auth::user()->subscription and $plan->name == Auth::user()->subscription->plan->name)
                                                <span class="current-plan">
                                                    Plano Atual
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script src="{{ asset('lib/fileuploader/dist/jquery.fileuploader.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('input[name="files"]').fileuploader({
                limit: 2,
                extensions: ['image/*'],
                fileMaxSize: 10,
                changeInput: ' ',
                theme: 'avatar',
                addMore: true,
                enableApi: true,
                thumbnails: {
                    box: '<div class="fileuploader-wrapper">' +
                            '<div class="fileuploader-items"></div>' +
                            '<div class="fileuploader-droparea" data-action="fileuploader-input"><i class="fileuploader-icon-main"></i></div>' +
                        '</div>' +
                            '<div class="fileuploader-menu">' +
                                '<button type="button" class="fileuploader-menu-open"><i class="fileuploader-icon-menu"></i></button>' +
                                '<ul>' +
                                    '<li><a data-action="fileuploader-input"><i class="fileuploader-icon-upload"></i> ${captions.upload}</a></li>' +
                                    '<li><a data-action="fileuploader-edit"><i class="fileuploader-icon-edit"></i> ${captions.edit}</a></li>' +
                                    '<li><a data-action="fileuploader-remove"><i class="fileuploader-icon-trash"></i> ${captions.remove}</a></li>' +
                                '</ul>' +
                            '</div>',
                    item: '<div class="fileuploader-item">' +
                            '${image}' +
                            '<span class="fileuploader-action-popup" data-action="fileuploader-edit"></span>' +
                            '<div class="progressbar3" style="display: none"></div>' +
                            '</div>',
                    item2: null,
                    itemPrepend: true,
                    startImageRenderer: true,
                    canvasImage: false,
                    _selectors: {
                        list: '.fileuploader-items'
                    },
                    popup: {
                        arrows: false,
                        onShow: function(item) {
                            item.popup.html.addClass('is-for-avatar');
                            item.popup.html.on('click', '[data-action="remove"]', function(e) {
                                item.popup.close();
                                item.remove();
                            }).on('click', '[data-action="cancel"]', function(e) {
                                item.popup.close();
                            }).on('click', '[data-action="save"]', function(e) {
                                if (item.editor && !item.isSaving) {
                                    item.isSaving = true;
                                    item.editor.save();
                                }
                                if (item.popup.close)
                                    item.popup.close();
                            });
                        },
                        onHide: function(item) {
                            if (!item.isSaving && !item.uploaded && !item.appended) {
                                item.popup.close = null;
                                item.remove();
                            }
                        } 	
                    },
                    onItemShow: function(item) {
                        if (item.choosed)
                            item.html.addClass('is-image-waiting');
                    },
                    onImageLoaded: function(item, listEl, parentEl, newInputEl, inputEl) {
                        if (item.choosed && !item.isSaving) {
                            if (item.reader.node && item.reader.width >= 256 && item.reader.height >= 256) {
                                item.image.hide();
                                item.popup.open();
                                item.editor.cropper();
                            } else {
                                item.remove();
                                alert('The image is too small!');
                            }
                        } else if (item.data.isDefault)
                            item.html.addClass('is-default');
                        else if (item.image.hasClass('fileuploader-no-thumbnail'))
                            item.html.hide();
                    },
                    onItemRemove: function(html) {
                        html.fadeOut(250, function() {
                            html.remove();
                        });
                    }
                },
                dragDrop: {
                    container: '.fileuploader-wrapper'
                },
                editor: {
                    cropper: {
                        ratio: '1:1',
                        minWidth: 256,
                        minHeight: 256,
                        showGrid: false
                    },
                    onSave: function(base64, item, listEl, parentEl, newInputEl, inputEl) {
                        var api = $.fileuploader.getInstance(inputEl);
                        
                        if (item.upload) {
                            if (api.getFiles().length == 2 && (api.getFiles()[0].data.isDefault || api.getFiles()[0].upload))
                                api.getFiles()[0].remove();
                            parentEl.find('.fileuploader-menu ul a').show();
                            
                            if (item.upload.send)
                                return item.upload.send();
                            if (item.upload.resend)
                                return item.upload.resend();
                        } else if (item.appended) {
                            // hide current thumbnail (this is only animation)
                            item.image.addClass('fileuploader-loading').html('');
                            item.html.find('.fileuploader-action-popup').hide();
                            parentEl.find('[data-action="fileuploader-edit"]').hide();

                            $.ajax({
                                url: '/user/ajax_resize_file',
                                method: 'POST',
                                data: {
                                    _token: inputEl.attr('data-upload-token'),
                                    name: item.name, 
                                    _editor: JSON.stringify(item.editor), 
                                    fileuploader: 1
                                },
                                success: function(retorno) {
                                    console.log('Success');
                                    console.log(retorno);
                                    item.reader.read(function() {
                                        item.html.find('.fileuploader-action-popup').show();
                                        parentEl.find('[data-action="fileuploader-edit"]').show();
                                        
                                        item.popup.html = item.popup.editor = item.editor.crop = item.editor.rotation = item.popup.zoomer = null;
                                        item.renderThumbnail();
                                    }, null, true);
                                },
                                error: function(retorno) {
                                    console.log('Error');
                                    console.log(retorno);
                                }
                            }).always(function() {
                                delete item.isSaving;
                            });
                        }
                    }
                },
                upload: {
                    url: '/user/ajax_upload_file',
                    data: null,
                    type: 'POST',
                    enctype: 'multipart/form-data',
                    start: false,
                    beforeSend: function(item, listEl, parentEl, newInputEl, inputEl) {
                        if (item.editor && (typeof item.editor.rotation != "undefined" || item.editor.crop)) {
                            item.upload.data.fileuploader = 1;
                            item.upload.data.name = item.name;
                            item.upload.data._editorr = JSON.stringify(item.editor);
                        }

                        item.upload.data._token = inputEl.attr('data-upload-token');
                        
                        item.image.hide();
                        item.html.removeClass('upload-complete');
                        parentEl.find('[data-action="fileuploader-edit"]').hide();
                        this.onProgress({percentage: 0}, item);
                    },
                    onSuccess: function(result, item, listEl, parentEl, newInputEl, inputEl) {
                        console.log(result);
                        
                        var api = $.fileuploader.getInstance(inputEl),
                            $progressBar = item.html.find('.progressbar3'),
                            data = {};
                        
                        try {
                            data = JSON.parse(result);
                        } catch (e) {
                            data.hasWarnings = true;
                        }
                        
                        if (api.getFiles().length > 1)
                            api.getFiles()[0].remove();
                        
                        // if success
                        if (data.isSuccess && data.files[0]) {
                            item.name = data.files[0].name;
                        }
                        
                        // if warnings
                        if (data.hasWarnings) {
                            for (var warning in data.warnings) {
                                alert(data.warnings[warning]);
                            }
                            
                            item.html.removeClass('upload-successful').addClass('upload-failed');
                            return this.onError ? this.onError(item) : null;
                        }
                        
                        delete item.isSaving;
                        item.html.addClass('upload-complete').removeClass('is-image-waiting');
                        $progressBar.find('span').html('<i class="fileuploader-icon-success"></i>');
                        parentEl.find('[data-action="fileuploader-edit"]').show();
                        setTimeout(function() {
                            $progressBar.fadeOut(450);
                        }, 1250);
                        item.image.fadeIn(250);
                    },
                    onError: function(item, listEl, parentEl, newInputEl, inputEl) {
                        var $progressBar = item.html.find('.progressbar3');
                        
                        item.html.addClass('upload-complete');
                        if (item.upload.status != 'cancelled')
                            $progressBar.find('span').attr('data-action', 'fileuploader-retry').html('<i class="fileuploader-icon-retry"></i>');
                    },
                    onProgress: function(data, item) {
                        var $progressBar = item.html.find('.progressbar3');
                        
                        if (data.percentage == 0)
                            $progressBar.addClass('is-reset').fadeIn(250).html('');
                        else if (data.percentage >= 99)
                            data.percentage = 100;
                        else
                            $progressBar.removeClass('is-reset');
                        if (!$progressBar.children().length)
                            $progressBar.html('<span></span><svg><circle class="progress-dash"></circle><circle class="progress-circle"></circle></svg>');
                        
                        var $span = $progressBar.find('span'),
                            $svg = $progressBar.find('svg'),
                            $bar = $svg.find('.progress-circle'),
                            hh = Math.max(60, item.html.height() / 2),
                            radius = Math.round(hh / 2.28),
                            circumference = radius * 2 * Math.PI,
                            offset = circumference - data.percentage / 100 * circumference;
                        
                        $svg.find('circle').attr({
                            r: radius,
                            cx: hh,
                            cy: hh
                        });
                        $bar.css({
                            strokeDasharray: circumference + ' ' + circumference,
                            strokeDashoffset: offset
                        });
                        
                        $span.html(data.percentage + '%');
                    },
                    onComplete: null,
                },
                afterRender: function(listEl, parentEl, newInputEl, inputEl) {
                    var api = $.fileuploader.getInstance(inputEl);
                    
                    // remove multiple attribute
                    inputEl.removeAttr('multiple');
                    
                    // disabled input
                    if (api.isDisabled()) {
                        parentEl.find('.fileuploader-menu').remove();
                    }
                    
                    // [data-action]
                    parentEl.on('click', '[data-action]', function() {
                        var $this = $(this),
                            action = $this.attr('data-action'),
                            item = api.getFiles().length ? api.getFiles()[api.getFiles().length-1] : null;
                        
                        switch (action) {
                            case 'fileuploader-input':
                                api.open();
                                break;
                            case 'fileuploader-edit':
                                if (item && item.popup) {
                                    item.popup.open();
                                    item.editor.cropper();
                                }
                                break;
                            case 'fileuploader-retry':
                                if (item && item.upload.retry)
                                    item.upload.retry();
                                break;
                            case 'fileuploader-remove':
                                if (item)
                                    item.remove();
                                break;
                        }
                    });
                    
                    // menu
                    $('body').on('click', function(e) {
                        var $target = $(e.target),
                            $parent = $target.closest('.fileuploader');
                        
                        $('.fileuploader-menu').removeClass('is-shown');
                        if ($target.is('.fileuploader-menu-open') || $target.closest('.fileuploader-menu-open').length)
                            $parent.find('.fileuploader-menu').addClass('is-shown');
                    });
                },
                onEmpty: function(listEl, parentEl, newInputEl, inputEl) {
                    var api = $.fileuploader.getInstance(inputEl),
                        defaultAvatar = inputEl.attr('data-fileuploader-default');
                    
                    if (defaultAvatar && !listEl.find('> .is-default').length)
                        api.append({name: '', type: 'image/png', size: 0, file: defaultAvatar, data: {isDefault: true, popup: false, listProps: {is_default: true}}});
                    
                    parentEl.find('.fileuploader-menu ul a').hide().filter('[data-action="fileuploader-input"]').show();
                },
                onRemove: function(item, listEl, parentEl, newInputEl, inputEl) {
                    if (item.name && (item.appended || item.uploaded)) {
                        $.ajax({
                            url: '/user/ajax_remove_file',
                            method: 'POST',
                            data: {
                                _token: inputEl.attr('data-upload-token'),
                                file: item.name,
                            },
                            success: function(retorno) {
                                console.log('Success');
                                console.log(retorno);
                            },
                            error: function(retorno) {
                                console.log('Error');
                                console.log(retorno);
                            }
                        });
                    }
                },
                captions: {
                    edit: 'Editar',
                    upload: 'Upload',
                    remove: 'Remover',
                    errors: {
                        filesLimit: 'Apenas um arquivo pode ser carregado de uma vez.',
                    }
                }
            });
        });
    </script>
@endsection