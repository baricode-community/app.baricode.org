<?php

test('home page is accessible', function () {
    $this->get(route('home'))->assertOk();
});

test('about page is accessible', function () {
    $this->get(route('about'))->assertOk();
});

test('bmc page is accessible', function () {
    $this->get(route('bmc'))->assertOk();
});

test('bmc page renders the correct view', function () {
    $this->get(route('bmc'))->assertViewIs('pages.general.bmc.index');
});

test('roadmap page is accessible', function () {
    $this->get(route('roadmap'))->assertOk();
});

test('terms page is accessible', function () {
    $this->get(route('terms'))->assertOk();
});

test('privacy page is accessible', function () {
    $this->get(route('privacy'))->assertOk();
});
