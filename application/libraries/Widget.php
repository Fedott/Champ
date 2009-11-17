<?php
class Widget_Core {
    protected $cache = FALSE; // object Cache
    protected $cache_life_time = 0; //время жизни кэша
    protected $widget_cache = FALSE; //закешированный компонент

    /**
     *
     * @param bool $cache //брать компонент из кэша?
     */
    function __construct($cache = FALSE) {
        if($cache) {
            $this->cache = new Cache();
            $this->widget_cache = $this->cache->get(get_class($this));
        }

    }

    /**
     * Создает и возращает объект Widget
     *
     * @param   string Widget name
     * @param   bool   
     * @return  Widget
     */
    
    public function factory($widget_name, $cache = FALSE) {

        require Kohana::find_file('widgets', $widget_name);

        $widget_class = ucfirst($widget_name).'_Widget';

        return new $widget_class($cache);

    }

    /**
     * Возвращает компонент, либо из кэша, либо возращенная методом Run строка
     *
     * @return unknown
     */
    public function render() {
        $widget =  $this->widget_cache;
        if(!$widget) {
            $widget = $this->run();

            if($this->cache) {
                $this->cache->set(get_class($this), $widget, NULL, $this->cache_life_time);
            }

        }

        return $widget;
    }

    /**
     * Возрвращает компонент
     * Метод обязательно должен быть переопределен в классах потомках
     * 
     * @return 
     *
     */
    protected function run() {}

}