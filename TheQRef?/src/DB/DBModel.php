<?php

namespace DB;

interface DBModel {
    public function save();
    public function load($pk);
    public function delete();
}
