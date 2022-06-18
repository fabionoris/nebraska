(function () {
    tinymce.create('tinymce.plugins.lambdatiny', {
        init: function (ed, url) {
            ed.addButton('themecolor', {
                title: 'Themecolor',
                image: url + '/icons/color_management.png',
                onclick: function () {
                    ed.selection.setContent('[themecolor]' + ed.selection.getContent() + '[/themecolor]');
                }
            }),
                ed.addButton('break', {
                    title: 'Break (use when "disable WPAutoTags" Option is enabled)',
                    image: url + '/icons/break.png',
                    onclick: function () {
                        ed.selection.setContent('[br]');
                    }
                }),
                ed.addButton('paragraph', {
                    title: 'Paragraph (use when "disable WPAutoTags" Option is enabled)',
                    image: url + '/icons/paragraph.png',
                    onclick: function () {
                        ed.selection.setContent('[p]' + ed.selection.getContent() + '[/p]');
                    }
                }),
                ed.addButton('headline_h1', {
                    title: 'H1',
                    image: url + '/icons/h1.png',
                    onclick: function () {
                        ed.selection.setContent('[h1]' + ed.selection.getContent() + '[/h1]');
                    }
                }),
                ed.addButton('headline_h2', {
                    title: 'H2',
                    image: url + '/icons/h2.png',
                    onclick: function () {
                        ed.selection.setContent('[h2]' + ed.selection.getContent() + '[/h2]');
                    }
                }),
                ed.addButton('headline_h3', {
                    title: 'H3',
                    image: url + '/icons/h3.png',
                    onclick: function () {
                        ed.selection.setContent('[h3]' + ed.selection.getContent() + '[/h3]');
                    }
                }),
                ed.addButton('headline_h4', {
                    title: 'H4',
                    image: url + '/icons/h4.png',
                    onclick: function () {
                        ed.selection.setContent('[h4]' + ed.selection.getContent() + '[/h4]');
                    }
                }),
                ed.addButton('headline_h5', {
                    title: 'H5',
                    image: url + '/icons/h5.png',
                    onclick: function () {
                        ed.selection.setContent('[h5]' + ed.selection.getContent() + '[/h5]');
                    }
                }),
                ed.addButton('headline_h6', {
                    title: 'H6',
                    image: url + '/icons/h6.png',
                    onclick: function () {
                        ed.selection.setContent('[h6]' + ed.selection.getContent() + '[/h6]');
                    }
                }),
                ed.addCommand('scgenerator', function () {
                    ed.windowManager.open({
                        file: url + '/lambda.sc.generator.php',
                        width: 450,
                        height: 600,
                        inline: 1
                    });
                }),
                ed.addCommand('lambdabutton', function () {
                    ed.windowManager.open({
                        file: url + '/lambda.button.popup.php',
                        width: 450,
                        height: 420,
                        inline: 1
                    });
                }),
                ed.addCommand('lambdatables', function () {
                    ed.windowManager.open({
                        file: url + '/lambda.table.popup.php',
                        width: 450,
                        height: 250,
                        inline: 1
                    });
                }),
                ed.addCommand('lambdavimeo', function () {
                    ed.windowManager.open({
                        file: url + '/lambda.vimeo.popup.php',
                        width: 450,
                        height: 250,
                        inline: 1
                    });
                }),
                ed.addCommand('lambdayoutube', function () {
                    ed.windowManager.open({
                        file: url + '/lambda.youtube.popup.php',
                        width: 450,
                        height: 250,
                        inline: 1
                    });
                }),
                ed.addCommand('lambdasoundcloud', function () {
                    ed.windowManager.open({
                        file: url + '/lambda.soundcloud.popup.php',
                        width: 450,
                        height: 250,
                        inline: 1
                    });
                }),
                ed.addCommand('lambdagoogle', function () {
                    ed.windowManager.open({
                        file: url + '/lambda.google.popup.php',
                        width: 450,
                        height: 250,
                        inline: 1
                    });
                }),
                ed.addCommand('lambdacta', function () {
                    ed.windowManager.open({
                        file: url + '/lambda.cta.popup.php',
                        width: 450,
                        height: 370,
                        inline: 1
                    });
                }),
                ed.addCommand('lambdasliders', function () {
                    ed.windowManager.open({
                        file: url + '/lambda.slider.popup.php',
                        width: 450,
                        height: 250,
                        inline: 1
                    });
                });
            // Register buttons
            ed.addButton('scgenerator', {
                title: 'Add Custom Shortcode',
                cmd: 'scgenerator',
                image: url + '/icons/shortcodes.png'
            });
            ed.addButton('lambda_buttons', {
                title: 'Insert Button',
                cmd: 'lambdabutton',
                image: url + '/icons/buttons.png'
            });
            ed.addButton('lambda_sliders', {
                title: 'Insert Slider',
                cmd: 'lambdasliders',
                image: url + '/icons/sliders.png'
            });
            ed.addButton('lambda_tables', {
                title: 'Insert Table',
                cmd: 'lambdatables',
                image: url + '/icons/tables.png'
            });
            ed.addButton('lambda_vimeo', {
                title: 'Insert Vimeo Video',
                cmd: 'lambdavimeo',
                image: url + '/icons/vimeo.png'
            });
            ed.addButton('lambda_youtube', {
                title: 'Insert Youtube Video',
                cmd: 'lambdayoutube',
                image: url + '/icons/youtube.png'
            });
            ed.addButton('lambda_soundcloud', {
                title: 'Insert Soundcloud',
                cmd: 'lambdasoundcloud',
                image: url + '/icons/soundcloud.png'
            });
            ed.addButton('lambda_google', {
                title: 'Insert Google Map',
                cmd: 'lambdagoogle',
                image: url + '/icons/map.png'
            });
            ed.addButton('lambda_cta', {
                title: 'Insert Call to Action',
                cmd: 'lambdacta',
                image: url + '/icons/cta.png'
            });
        },
        createControl: function (n, cm) {
            return null;
        },
        getInfo: function () {
            return {
                longname: 'Lambda TinyMCE',
                author: 'Matthias Nettekoven Marcel Moerkens - UnitedThemes',
                authorurl: 'http://unitedthemes.com',
                infourl: 'http://unitedthemes.com',
                version: tinymce.majorVersion + "." + tinymce.minorVersion
            };
        }
    });
    tinymce.PluginManager.add('lambda_buttons', tinymce.plugins.lambdatiny);
})();