<!DOCTYPE html><html><head><title><?php echo (! empty($this->title)) ? $this->title ." | " .$this->siteConfig["title"] : $this->siteConfig["title"]; ?></title><link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/normalize.css"><link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/reset.css"><link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/general.css"><link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous"><!-- Mobile specific --><meta name="viewport" content="width=device-width,initial-scale=1"><meta name="theme-color" content="darkslategray"><link rel="icon" href="<?php echo BASE_URL; ?>assets/img/favicon.png"></head><body><?php $this->loadViewIntoTemplate($viewName, $viewData); ?></body></html>