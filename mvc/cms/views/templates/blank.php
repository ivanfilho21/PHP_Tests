<!DOCTYPE html><html><head><title><?php echo (! empty($this->title)) ? $this->title ." | " .$this->siteConfig["title"] : $this->siteConfig["title"]; ?></title></head><body><?php $this->loadViewIntoTemplate($viewName, $viewData); ?></body></html>