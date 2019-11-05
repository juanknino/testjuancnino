<?php


class Class_image{
    public $form='';
        function __construct()
        {
            $html='';
            $html.='<!-- IMAGE -->';
            //nombre
            $html.='<div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" name="image[name]"/>
                    </div>';
            //link
            $html.='<div class="form-group col-6">
                        <label for="image">URL Imagen:</label>
                        <input type="url" class="form-control" name="image[url]"/>
                    </div>';
            //formato
            $html.='<div class="form-group col-2">
                        <label for="formato">Formato:</label>
                        <input type="text" class="form-control" name="image[type]"/>
                    </div>';
            //posicion
            $html.='<div class="form-group row">
                        <div class="col-2"><span>Posición:</span></div>
                        <div class="col-2">
                            <label for="position">X:</label>
                            <input type="number" class="form-control inputpx" name="image[position][x]"/><span></span>
                        </div>
                        <div class="col-2">
                            <label for="position">Y:</label>
                            <input type="number" class="form-control inputpx" name="image[position][y]"/><span></span>
                        </div>
                        <div class="col-4">
                            <label for="position">Z:</label>
                            <div class="row">
                                <div class="radio ml-3"><input autocomplete="off" type="radio" name="image[position][z]" id="value_1" value="auto"><label for="value_1">&nbsp;auto</label></div>
                                <div class="radio ml-3"><input autocomplete="off" type="radio" name="image[position][z]" id="value_2" value="1"><label for="value_2">&nbsp;1</label></div>
                                <div class="radio ml-3"><input autocomplete="off" type="radio" name="image[position][z]" id="value_3" value="2"><label for="value_3">&nbsp;2</label></div>
                                <div class="radio ml-3"><input autocomplete="off" type="radio" name="image[position][z]" id="value_4" value="3"><label for="value_4">&nbsp;3</label></div>
                                <div class="radio ml-3"><input autocomplete="off" type="radio" name="image[position][z]" id="value_6" value="initial"><label for="value_6">&nbsp;initial</label></div>
                            </div>
                        </div>
                    </div><br>';
            //dimensiones
            $html.='<div class="form-group row mt-2">
                        <div class="col-2"><span>Dimensiones:</span></div>
                        <div class="col-2">
                            <label for="position">Alto:</label>
                            <input type="number" class="form-control inputpx" name="image[dim][w]"/><span></span>
                        </div>
                        <div class="col-2">
                            <label for="position">Ancho:</label>
                            <input type="number" class="form-control inputpx" name="image[dim][h]"/><span></span>
                        </div>
                    </div>';

            $this->form=$html;
        }

}
