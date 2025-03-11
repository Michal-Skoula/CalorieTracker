<x-layouts.app title="Dashboard">
    <div class="mb-4">
        <flux:heading level="1" size="xl">Add a new meal</flux:heading>
        <flux:subheading>Use AI to analyze the nutritional contents of a meal and log your caloric intake.</flux:subheading>
    </div>
    <flux:separator class="mb-8"/>
    
    <form action="{{route('app.meal.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid sm:grid-cols-2 grid-cols-1 mb-10 gap-10">
            <flux:field>
                <flux:label>Picture of meal</flux:label>
                <flux:description>Make sure the whole meal is visible and lit up</flux:description>
                <flux:input type="file" name="image" required/>
                <flux:error name="image"/>
            </flux:field>
            <flux:field class="sm:row-auto row-span-1">
                <flux:label>Day</flux:label>
                <flux:description>When did you have this?</flux:description>
                <flux:input type="date" name="day" :value="today()->format('Y-m-d')" required/>
                <flux:error name="day"/>
            </flux:field>
        </div>
        <div class="mb-10">
            <flux:field>
                <flux:label>Description <flux:badge color="blue">Optional</flux:badge></flux:label>
                <flux:description>Help the AI by giving it more context about the meal, such as portion size, count, etc.</flux:description>
                <flux:textarea
                    rows="3"
                    resize="none"
                    name="prompt"
                    placeholder="Large pepperoni pizza with peppers and garlic"/>
                <flux:error name="prompt"/>
            </flux:field>
        </div>
        
        <flux:button
            type="submit"
            icon-trailing="sparkles"
            variant="primary"
        >
            Analyze meal
        </flux:button>
    </form>
</x-layouts.app>
