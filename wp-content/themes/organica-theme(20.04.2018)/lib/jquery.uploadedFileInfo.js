/**
 * Показывает свойства загружаемого/загруженного файла. Только ОДНОГО файла!
 * Плагин не загружает файлы, он только отображает информацию.
 * Также плагин не создаёт дополнительную разметку, он привязывается к уже существующей вёрстке.
 *
 * @author Borovskih Pavel
 * @version 0.9.9a
 *
 * @todo
 * 1) Возможность удаления существующего файла или проставления признака "на удаление" (?)
 * 2) Посмотреть работу плагина при инициализации одновременно для нескольких элементов (+)
 * 3) Переписать код, включая во внимание, что загружаются не только изображения,
 * но и обычные файлы + учитывать дефолтные значения (как объект со значениям, так и просто путь до ФАЙЛА!) при ошибке/удалении (+)
 * 4) Возможность скрывать родной инпут после инициализации (+)
 * 5) Реализовать emptySrc как строковый параметр, являющийся по сути тем же самым preview (+)
 * 6) Реализовать сеттеры (+)
 * 7) Добавить элемент browse (+)
 * 8) Изменить логику remove (-/+) // Как быть, если preview - <img>?
 * 9) Реализовать disabled (+)
 * 10) Рефакторинг кода (?)
 * 11) Реализовать коллбэк onCompleteAfter (+)
 * 12) Описать параметры (?)
 * 13) Мульти превью (?)
 * 14) preloader (?)
 */

;(function($){

    var defaults = {
        // Свойства загруженного файла для первичного отображения при загрузке.
        // Может также быть строкой, содержащей путь до файла от корня.
        file: {
            name: null,
            size: null,
            src: null
        },

        maxSize: 3 * 1024 * 1024, // Максимально разрешенный размер фйла
        extRegexp: /\.(png|jpe?g|gif)$/i, // Регулярное выражение для проверки допустимых форматов файлов
        emptySrc: null, // Заглушка. Привязывается к элементу preview
        hideInput: true, // Скрывать ли родной инпут
        disabled: false, // Сделать инпут неактивным. При значении true выбрать файл будет невозможно.

        disabledClass: 'ufi--disabled', // Класс при установлении опции disabled = true
        removeClass: 'ufi-remove', // Класс для кнопки удаления превью, если элемент remove был передан со значением true

        // Селекторы элементов
        elements: {
            filename: null, // Элемент, содержащий имя файла
            filesize: null, // Элемент, содержащий размер файла
            preview: null, // Элемент для отображения превью файла
            browse: null, // Элемент, при клике на который будет открываться диалог выбора файла
            remove: null, // Элемент удаления превью. Создаётся автоматически внутри элемента preview, если передано значение true. Или можно указать селектор или произвольную валидную разметку тега
        },

        onComplete: null,
        onCompleteAfter: null,
        onError: null,
        onErrorAfter: null,
        onRemove: null,
        onRemoveAfter: null
    };

    $.fn.uploadedFileInfo = function(params, settings){

        var options = $.extend(true, {}, defaults, params),
            elements = {},
            defaultFile = {}, // дефолтные свойства файла на момент инициализции
            selectedPreview = false, // является ли превью выбранным изображением пользователя
            $element;

        return this.each(function(el){

            $element = $(this);

            // SETTERS
            if (typeof params === 'string') {
                var instance = $.data(this, 'ufi');
                $element = instance.target;
                options = instance.options;
                elements = instance.elements;
                defaultFile = instance.defaultFile,
                selectedPreview = instance.selectedPreview;
                switch(params) {
                    case 'maxSize':
                    case 'extRegexp':
                        options[params] = settings;
                        break;

                    case 'emptySrc':
                        options[params] = settings;
                        defaultFile.src = settings;
                        _initPreview(settings, true);
                        break;

                    case 'hideInput':
                        options[params] = settings;
                        _hideInput(settings);
                        break;

                    case 'disabled':
                        options[params] = settings;
                        _disabled(settings);
                        break;

                    default:
                        $.error('Option ' + params + ' is unknown or unavailable');
                        break;
                }
                return;
            }

            // Избавимся от повторный инициализации
            if ($element.data('ufi')) {
                return;
            }

            // Сохраним переданные элементы
            for (var key in options.elements) {
                if (!options.elements.hasOwnProperty(key)) {
                    continue;
                }
                if (key == 'remove' && elements.preview) {
                    if (options.elements.remove === true) {
                        var $remove = $('<button>', {type: 'button', class: options.removeClass}).text('×');
                        elements.preview.append($remove);
                        elements.remove = $remove;
                        continue
                    }
                    else if (typeof options.elements.remove === 'string' && (/^<+/i).test(options.elements.remove)) {
                        var $remove = $(options.elements.remove).addClass(options.removeClass);
                        elements.preview.append($remove);
                        elements.remove = $remove;
                        continue
                    }
                }
                elements[key] = $(options.elements[key]);
            }

            elements.remove.hide();
            elements.filename.hide();
            elements.filesize.hide();
            elements.preview.hide();

            // Скрываем родной инпут
            if (options.hideInput) {
                _hideInput(true);
            }

            // Делаем выбор недоступным
            if (options.disabled) {
                _disabled(true);
            }

            // Получаем свойства текущего файла из data-атрибута, если есть
            options.file = $element.data('file') || options.file;

            // Если были указаны данные для первичного (дефолтного) отображения
            // загруженного файла, то сохраним их и отобразим.
            if ((typeof options.file === 'string' && options.file != '') || !$.isEmptyObject(options.file)) {
                defaultFile = {
                    src: typeof options.file === 'string' ? options.file : options.file.src,
                    name: options.file.name,
                    size: options.file.size
                };
                _complete(defaultFile, true);
            }

            // Устанавливаем значение для заглушки.
            // По сути, заглушка - это тот же самый предустановленный src
            // для первичного (дефолтного) отображения загруженного файла.
            if (!defaultFile.src && options.emptySrc) {
                defaultFile.src = options.emptySrc;
                _initPreview(options.emptySrc, true);
            }

            // Навешиваем событие на элемент удаления файла
            if (elements.remove) {
                elements.remove.bind('click.ufi', _remove);
            }

            // Навешиваем событие открытия окна выбора файла для элемента browse
            if (elements.browse) {
                elements.browse.bind('click.ufi', function(e){
                    e.stopPropagation();
                    if (e.target !== elements.remove) {
                        $element.trigger('click.ufi');
                    }
                    return false;
                });
            }

            $element.bind('click.ufi', function(e){
                e.stopPropagation();
            });

            $element.change(function () {
                // Определим версию IE
                // Если используется IE <= 9, то для него возможно будет вернуть только имя файла
                var ua = window.navigator.userAgent;
                var msie = ua.indexOf("MSIE ");
                if (parseInt(ua.substring(msie + 5, ua.indexOf(".", msie))) <= 9) {
                    var file = {},
                        value = this.value,
                        filename = value.split('\\').join('/'),
                        errors = [];

                    filename = filename.substr(filename.lastIndexOf('/') + 1);

                    if (options.extRegexp && !(options.extRegexp).test(filename)) {
                        errors.push('Формат файла не соотвествует требованиям');
                    }

                    if (errors.length) {
                        _error(errors);
                        //this.value = '';
                        return false;
                    }

                    // Добавим свойство
                    file.name = filename;
                    _complete(file);

                    return;
                }

                // Иначе пользователь использует другой современный (надеюсь) браузер.
                // Работа с файлами осуществляется через File API браузера.

                var file = this.files[0],
                    errors = [];

                if (!(window.File && window.FileReader && window.FileList && window.Blob)) {
                    alert('File upload not supported by your browser.');
                    return;
                }
                if (options.extRegexp && !(options.extRegexp).test(file.name)) {
                    errors.push("Формат файла не соотвествует требованиям");
                }
                if (options.maxSize && file.size > options.maxSize) {
                    errors.push('Размер файла превышает максимальный размер ' + bytesToSize(options.maxSize));
                }

                if (errors.length) {
                    _error(errors);
                    //this.value = '';
                    return false;
                }

                var reader = new FileReader();
                reader.addEventListener("load", function () {
                    var src = reader.result;
                    // Добавим свойство
                    file.src = src;
                    _complete(file);
                }, false);
                reader.readAsDataURL(file);
            });

            $element.data('ufi', {
                target: $element,
                options: options,
                elements: elements,
                defaultFile: defaultFile,
                selectedPreview: selectedPreview
            });

        });

        function _disabled(status)
        {
            if (status === true) {
                $element.attr('disabled', true);
                $element
                    .add(elements.remove)
                    .add(elements.filename)
                    .add(elements.filesize)
                    .add(elements.preview)
                    .add(elements.browse)
                    .addClass(options.disabledClass);
            } else {
                $element.attr('disabled', false);
                $element
                    .add(elements.remove)
                    .add(elements.filename)
                    .add(elements.filesize)
                    .add(elements.preview)
                    .add(elements.browse)
                    .removeClass(options.disabledClass);
            }
        }

        function _hideInput(status)
        {
            if (status === true) {
                $element.wrap('<div></div>').parent().css({
                    position: 'absolute',
                    top: 0,
                    left: -9999 + 'px',
                    visibility: 'hidden'
                });
            } else {
                $element.unwrap();
            }
        }

        function _setSelectedPreview(status)
        {
            status = selectedPreview = Boolean(status);
            if (!status) {
                $element.val('');
            }
            var data = $element.data('ufi');
            if (data) {
                data.target = $element; // нужно ли?
                data.selectedPreview = status;
                $element.data('ufi', data);
            }
        }

        function _error(e)
        {
            if ($.isFunction(options.onError)) {
                options.onError(e);
            } else {
                _onError(e);
            }
            _setSelectedPreview(false);
        }

        function _onError(e)
        {
            alert(e.join("\n"));

            elements.remove.hide();
            elements.filename.hide();
            elements.filesize.hide();

            _onComplete(true);

            if ($.isFunction(options.onErrorAfter)) {
                options.onErrorAfter(e);
            }
        }

        function _complete(f, onInit)
        {
            _setSelectedPreview( !onInit );

            if ($.isFunction(options.onComplete)) {
                options.onComplete(f, onInit);
            } else {
                _onComplete(f, onInit);
            }

            if ($.isFunction(options.onCompleteAfter)) {
                options.onCompleteAfter(f, onInit);
            }
        }

        function _onComplete(f, onInit)
        {
            if (f !== true && !onInit) {
                elements.remove.show();
            }

            // Загружаем дефолтный файл
            if (f === true) {
                f = defaultFile;
            }

            if (f.name) {
                elements.filename.html(f.name).show();
            }
            if (f.size) {
                elements.filesize.html( bytesToSize(f.size) ).show();
            }

            _initPreview(f.src);
        }

        function _remove()
        {
            var newSelectedPreview;
            if ($.isFunction(options.onRemove)) {
                newSelectedPreview = options.onRemove();
            } else {
                newSelectedPreview = _onRemove();
            }

            // Если используется пользовательская функция и при этом необходимо,
            // чтобы после результат не очищал инпут, то нужно, чтобы
            // функция возвращала true. Это удобно, к примеру, при использования
            // confirm('Вы уверены, что хотите удалить?').
            _setSelectedPreview(newSelectedPreview);

            if ($.isFunction(options.onRemoveAfter)) {
                options.onRemoveAfter();
            }

            return false;
        }

        function _onRemove()
        {
            elements.remove.hide();
            elements.filename.hide();
            elements.filesize.hide();

            _onComplete(true);
        }

        function _initPreview(src, isCap)
        {
            if (!src && !selectedPreview) {
                elements.preview.hide();
                return;
            }

            if (isCap && selectedPreview) {
                // show preview?
                return;
            }

            if (elements.preview.is('img')) {
                elements.preview.attr('src', src);
            } else {
                elements.preview.css('background-image', 'url(' + src + ')');
            }

            elements.preview.show();
        }

    };

    function bytesToSize(bytes) {
        var sizes = ['Б', 'КБ', 'МБ', 'ГБ', 'ТБ'];
        if (bytes == 0) {
            return '0 B';
        }
        var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
        return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
    }

})(jQuery);