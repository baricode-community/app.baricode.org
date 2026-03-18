<?php

test('seharusnya redirect', function () {
    $response = $this->get(route('home'));

    $response->assertStatus(200);
});
