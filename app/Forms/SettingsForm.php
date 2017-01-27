<?php

/*
 * ProVision Administration, http://ProVision.bg
 * Author: Venelin Iliev, http://veneliniliev.com
 */

namespace ProVision\Administration\Forms;

class SettingsForm extends AdminForm
{
    public function buildForm()
    {
        /*
         * base settings
         */
//        $this->add('base_settings_' . str_random(5), 'static', [
//            'tag' => 'h4',
//            'value' => 'Основни настройки',
//            'label' => false
//        ]);

        $this->addSeoFields(true, [
            'meta_title',
            'meta_description',
            'meta_keywords'
        ]);
        $this->add('html_minify', 'checkbox', [
            'label' => 'HTML Minify',
            'help_block' => [
                'text' => 'Дали да минифицира HTML кода'
            ]
        ]);

        /*
         * load settings of modules
         */
        $modules = \ProVision\Administration\Administration::getModules();
        if ($modules) {
            foreach ($modules as $moduleArray) {
                $module = new $moduleArray['administrationClass'];
                if (method_exists($module, 'settings')) {
                    $this->add('module_static_' . str_random(5), 'static', [
                        'tag' => 'h4',
                        'value' => 'Module ' . $moduleArray['name'],
                        'label' => false
                    ]);
                    $module->settings($moduleArray, $this);
                }
            }
        }

        $this->add('footer', 'admin_footer');
        $this->add('send', 'submit', [
            'label' => trans('administration::index.save'),
            'attr' => [
                'name' => 'save',
            ],
        ]);
    }
}