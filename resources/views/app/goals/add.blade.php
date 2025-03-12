<x-layouts.app title="Goals">
    <div class="mb-4">
        <flux:heading level="1" size="xl">Set your goals</flux:heading>
        <flux:subheading>Set your goals and start working towards achieving them!</flux:subheading>
    </div>
    <flux:separator class="mb-8"/>
    <form method="POST" action="{{route('app.goals.update')}}">
        @csrf
        @method('PATCH')
        <div class="grid sm:grid-cols-2 grid-cols-1 gap-10">
            <flux:radio.group name="weight_change_goal" class="mb-6">
                <flux:radio
                    label="Losing weight"
                    description="Sets your calorie goal as the maximum allowed daily calories."
                    value="cutting"
                    checked
                />
                <flux:radio
                    label="Gaining weight"
                    description="Sets your calorie goal as the daily minimum to reach."
                    value="bulking"
                />
                <flux:radio
                    label="Maintaining weight"
                    description="Checks if your daily calories are within 10% of your daily goal."
                    value="maintaining"
                />
            </flux:radio.group>
            <flux:field class="block! ">
                <flux:label>Calorie goal <span class="text-blue-300">(kcal)</span></flux:label>
                <flux:description>Daily calorie goal you want to work towards</flux:description>
                <flux:input
                    name="calorie_goal"
                    type="number"
                    inputtype="numeric"
                    placeholder="1200"
                    :value="$calorie_goal"
                    required
                />
                <flux:error/>
            </flux:field>
        </div>
        <div class="grid sm:grid-cols-2 grid-cols-1 gap-10">
            <flux:error for="weight_change_goal"></flux:error>
        </div>
        <flux:radio.group wire:model="payment" label="Select your payment method">
            <flux:radio value="cc" label="Credit Card" checked />
            <flux:radio value="paypal" label="Paypal" />
            <flux:radio value="ach" label="Bank transfer" />
        </flux:radio.group>
        
        <flux:button variant="primary" type="submit" class="cursor-pointer">Save changes</flux:button>
    </form>
</x-layouts.app>