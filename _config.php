<?php

use SilverStripe\Betamask;
use SilverStripe\FeatureFlag\FeatureFlag;

FeatureFlag::singleton()->register(Betamask\FeatureFlag::class);
