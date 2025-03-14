<div>
    <div class="mb-4">
        <flux:heading level="1" size="xl">Meal log</flux:heading>
        <flux:subheading>History of all of your meals, all in one place.</flux:subheading>
    </div>
    <flux:separator class="mb-8"/>
    @foreach($days as $day)
        <flux:heading level="2" size="lg">{{$day->getSemanticDayName()}}</flux:heading>
        <flux:subheading>{{$day->getFormattedDay()}}</flux:subheading>
        
        @foreach($day->meals as $meal)
            <div>
                {{$meal->name}}
{{--                @dd($meal->getImage())--}}
                <img src="{{$meal->getImageUrl()}}" alt="">
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

