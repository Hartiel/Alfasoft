<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Contact;
use App\Models\Person;

class FlowTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_person_successfully(): void
    {
        $response = $this->post(route('people.store'), [
            'name' => 'Person Test',
            'email' => 'persontest@test.com',
        ]);

        $response->assertRedirect(route('people.index'));
        $this->assertDatabaseHas('people', ['email' => 'persontest@test.com']);
    }

    /** @test */
    public function it_validate_duplicate_emails()
    {
        Person::create(['name' => 'Original', 'email' => 'persontest@teste.com']);

        // Try create another person with same email
        $response = $this->post(route('people.store'), [
            'name' => 'Doppleganger',
            'email' => 'persontest@teste.com',
        ]);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function it_can_add_a_contact_to_person()
    {
        $person = Person::create(['name' => 'Person Test', 'email' => 'persontest@test.com']);

        $response = $this->post(route('contacts.store'), [
            'person_id' => $person->id,
            'country_code' => '351',
            'number' => '900000000'
        ]);

        $response->assertRedirect(route('people.show', $person->id));

        $this->assertDatabaseHas('contacts', [
            'person_id' => $person->id,
            'number' => '900000000'
        ]);
    }

    /** @test */
    public function it_prevents_duplicate_contacts()
    {
        $person = Person::create(['name' => 'Person Test', 'email' => 'persontest@test.com']);

        Contact::create([
            'person_id' => $person->id,
            'country_code' => '351',
            'number' => '900000000'
        ]);

        // Try create another contact with same number and country_code
        $response = $this->post(route('contacts.store'), [
            'person_id' => $person->id,
            'country_code' => '351',
            'number' => '900000000'
        ]);

        $response->assertSessionHasErrors('number');
    }
}
