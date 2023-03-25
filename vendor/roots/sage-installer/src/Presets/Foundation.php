<?php

namespace Roots\Sage\Installer\Presets;

class Foundation extends Preset
{
    /** {@inheritdoc} */
    protected function updatePackagesArray(array $packages)
    {
        $packages['dependencies']['foundation-sites'] = '~6.6.3';
        return $packages;
    }
}
