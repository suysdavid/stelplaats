<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SortingController extends Controller
{
    protected $parkingsLarge = 4;
    protected $parkingsMedium = 6;
    protected $parkingsSmall = 10;

    public function index(Request $request)
    {
        // Get the JSON data from the request
        $input = $request->getContent();

        // Check if the input is empty
        if (empty($input)) {
            // Return an error
            return response()->json([
                'error' => 'No input'
            ]);
        }

        // Decode the json file
        $input = json_decode(json_decode($input));

        // Collect the data from the json file
        $data = collect($input);

        // Get the parking data
        $parking = collect($data->get('parking'));

        // Get the vehicles where the type is 'GROOT'
        $largeVehicles = $parking->where('type', 'GROOT');

        // Get the vehicles where the type is 'NORMAAL'
        $mediumVehicles = $parking->where('type', 'NORMAAL');

        // Get the vehicles where the type is 'MINI'
        $smallVehicles = $parking->where('type', 'MINI');

        // Concatenate the large, medium and small vehicles
        $vehicles = $largeVehicles
            ->concat($mediumVehicles)
            ->concat($smallVehicles);

        // Define the spaces used per vehicle type
        $spacesUsed = [
            'GROOT'     => 4,
            'NORMAAL'   => 2,
            'MINI'      => 1
        ];

        // Define the spaces left per garage type
        $spacesLeft = [
            'GROOT'     => $this->parkingsLarge * $spacesUsed['GROOT'],
            'NORMAAL'   => $this->parkingsMedium * $spacesUsed['NORMAAL'],
            'MINI'      => $this->parkingsSmall * $spacesUsed['MINI']
        ];

        // Define the output garage arrays
        $largeVehiclesGarage = [];
        $mediumVehiclesGarage = [];
        $smallVehiclesGarage = [];

        // Loop through the vehicles
        foreach ($vehicles as $vehicle) {
            // Check the vehicle type
            $vehicleType = $vehicle->type;

            // Get the spaces used
            $spacesUsedByVehicle = $spacesUsed[$vehicleType];

            // Check if there are enough spaces left in the large garage
            if ($spacesLeft['GROOT'] >= $spacesUsedByVehicle) {
                // Add the vehicle to the large garage
                $largeVehiclesGarage[] = $vehicle;

                // Subtract the spaces used from the spaces left in the large garage
                $spacesLeft['GROOT'] -= $spacesUsedByVehicle;

                // Continue to the next vehicle
                continue;
            }

            // Check if there are enough spaces left in the medium garage
            if ($spacesLeft['NORMAAL'] >= $spacesUsedByVehicle) {
                // Add the vehicle to the medium garage
                $mediumVehiclesGarage[] = $vehicle;

                // Subtract the spaces used from the spaces left in the medium garage
                $spacesLeft['NORMAAL'] -= $spacesUsedByVehicle;

                // Continue to the next vehicle
                continue;
            }

            // Check if there are enough spaces left in the small garage
            if ($spacesLeft['MINI'] >= $spacesUsedByVehicle) {
                // Add the vehicle to the small garage
                $smallVehiclesGarage[] = $vehicle;

                // Subtract the spaces used from the spaces left in the small garage
                $spacesLeft['MINI'] -= $spacesUsedByVehicle;
            }
        }

        // Define the new data
        $newData = [
            'stelplaats' => $data['stelplaats'],
            'parking' => [],
            'garage' => [
                'groot' => $largeVehiclesGarage,
                'medium' => $mediumVehiclesGarage,
                'klein' => $smallVehiclesGarage
            ],
        ];

        // Output the data as JSON
        return response()->json($newData);
    }
}
