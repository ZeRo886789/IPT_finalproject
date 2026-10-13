<?php
namespace Database\Seeders;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\ClothingOrder;
use App\Models\Measurement;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        User::factory()->create(['name'=>'Shop Admin','email'=>'admin@tailordesk.test','password'=>Hash::make('password')]);

        $customers=[
            ['name'=>'Maria Santos','phone'=>'0917 123 4567','email'=>'maria@example.com','address'=>'Tagbilaran City, Bohol'],
            ['name'=>'Juan Dela Cruz','phone'=>'0920 222 1045','email'=>'juan@example.com','address'=>'Panglao, Bohol'],
            ['name'=>'Angela Reyes','phone'=>'0918 442 7812','email'=>'angela@example.com','address'=>'Dauis, Bohol'],
            ['name'=>'Carlos Mendoza','phone'=>'0935 811 2004','email'=>'carlos@example.com','address'=>'Tagbilaran City, Bohol'],
            ['name'=>'Sofia Garcia','phone'=>'0998 456 9911','email'=>'sofia@example.com','address'=>'Baclayon, Bohol'],
            ['name'=>'Miguel Torres','phone'=>'0916 773 1190','email'=>'miguel@example.com','address'=>'Cortes, Bohol'],
            ['name'=>'Bea Villanueva','phone'=>'0927 305 8801','email'=>'bea@example.com','address'=>'Tagbilaran City, Bohol'],
            ['name'=>'Paolo Lim','phone'=>'0945 602 7143','email'=>'paolo@example.com','address'=>'Loon, Bohol'],
        ];
        foreach($customers as $i=>$data){ $data['customer_code']='CUS-'.str_pad($i+1,4,'0',STR_PAD_LEFT); Customer::create($data); }

        $employees=[
            ['name'=>'Ramon Cruz','role'=>'Master Tailor','phone'=>'0917 301 1101','email'=>'ramon@tailordesk.test'],
            ['name'=>'Liza Flores','role'=>'Seamstress','phone'=>'0918 402 2202','email'=>'liza@tailordesk.test'],
            ['name'=>'Mark Santos','role'=>'Cutter','phone'=>'0920 503 3303','email'=>'mark@tailordesk.test'],
            ['name'=>'Nina Aquino','role'=>'Tailor','phone'=>'0935 604 4404','email'=>'nina@tailordesk.test'],
            ['name'=>'Joel Ramos','role'=>'Cashier','phone'=>'0945 705 5505','email'=>'joel@tailordesk.test'],
        ];
        foreach($employees as $i=>$data){ $data['employee_code']='EMP-'.str_pad($i+1,4,'0',STR_PAD_LEFT); $data['hire_date']=now()->subYears($i+1)->toDateString(); Employee::create($data); }

        $garments=['Barong','School Uniform','Pants','Dress','Blouse','Suit','Barong Tagalog','Alteration'];
        $fabrics=['Linen','Cotton','Piqué','Rayon','Polyester','Silk Blend'];
        $statuses=['Pending','In Progress','Ready','Completed'];
        for($i=1;$i<=12;$i++){
            $order=ClothingOrder::create([
                'order_code'=>'ORD-'.str_pad($i,5,'0',STR_PAD_LEFT),
                'customer_id'=>(($i-1)%8)+1,'employee_id'=>($i%5)+1,
                'garment_type'=>$garments[($i-1)%count($garments)],'fabric'=>$fabrics[($i-1)%count($fabrics)],
                'color'=>['Cream','Navy','Black','White','Beige','Maroon'][$i%6],'size'=>['Custom','M','L','XL'][$i%4],
                'order_date'=>now()->subDays(20-$i)->toDateString(),'due_date'=>now()->addDays($i-5)->toDateString(),
                'total_amount'=>[850,1200,650,1800,950,3200][$i%6],'status'=>$statuses[($i-1)%4],
                'special_instructions'=>$i%3===0?'Allow extra room at the shoulder.':null
            ]);
            Measurement::create(['customer_id'=>$order->customer_id,'clothing_order_id'=>$order->id,'chest'=>38+$i%4,'waist'=>32+$i%3,'hip'=>39+$i%4,'shoulder'=>17+$i%2,'sleeve'=>23+$i%3,'neck'=>15+$i%2,'length'=>28+$i%3,'unit'=>'in','notes'=>'Standard fitting record.']);
            if($i%2===0){
                Payment::create(['clothing_order_id'=>$order->id,'payment_date'=>now()->subDays(max(1,15-$i))->toDateString(),'amount'=>min((float)$order->total_amount,400+($i*50)),'payment_method'=>['Cash','GCash','Bank Transfer'][$i%3],'reference_no'=>$i%3===0?'GCASH-'.$i:null,'status'=>'Paid']);
            }
        }
    }
}
