<div>
    <div class="mb-4">
        <flux:heading level="1" size="xl">Meal log</flux:heading>
        <flux:subheading>History of all of your meals, all in one place.</flux:subheading>
    </div>
    <flux:separator class="mb-8"/>
    @foreach($days as $day)
        <flux:heading level="2" size="lg">{{$day->getSemanticDayName()}}</flux:heading>
        <flux:subheading>{{$day->getFormattedDay()}}</flux:subheading>
        <p>Daily calories: {{$day->getCalories()}}</p>
        <flux:badge :color="$day->weight_change_goal->getColor()">{{$day->weight_change_goal->getName()}}</flux:badge>
        @foreach($day->meals as $meal)
            
            <div>
                {{$meal->name}}

                <img src="{{$meal->getImageUrl()}}" alt="">
                <flux:badge
                    :color="$meal->type->getColor()"
                    size="lg"
                >
                    {{$meal->type->getName()}}
                </flux:badge>
                {{$meal->type}} /
                {{$meal->description}}
                <div class="flex flex-col gap-2">
                    <p>Calories: {{$meal->calories}}</p>
                    <p>Carbs: {{$meal->carbs}}</p>
                    <p>Protein: {{$meal->protein}}</p>
                    <p>Fats: {{$meal->fats}}</p>
                </div>
            </div>
        @endforeach
        
    @endforeach
</div>

