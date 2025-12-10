<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\Contact;
use App\Models\Person;
use App\Services\CountryService;

class ContactController extends Controller
{
    protected $countryService;

    // Dependency Injection
    public function __construct(CountryService $countryService)
    {
        $this->countryService = $countryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Validate if find person_id in URL
        if (!$request->has('person_id')) {
            return redirect()
                ->route('people.index')
                ->with('error', 'First select person.');
        }

        $person = Person::findOrFail($request->person_id);

        // Get countries
        $countries = $this->countryService->getCountries();

        return view('contacts.create', compact('person', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContactRequest $request)
    {
        Contact::create($request->validated());

        return redirect()
            ->route('people.show', $request->person_id)
            ->with('success', 'Contact added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        $countries = $this->countryService->getCountries();
        $person = $contact->person;

        return view('contacts.edit', compact('contact', 'person', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {
        $contact->update($request->validated());

        return redirect()
            ->route('people.show', $contact->person_id)
            ->with('success', 'Contact updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $personId = $contact->person_id;

        $contact->delete();

        return redirect()
            ->route('people.show', $personId)
            ->with('success', 'Contact deleted successfully!');
    }
}
