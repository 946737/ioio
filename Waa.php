                    $nomerhp = $data_user['hp'];
                    $rigaming = 'udTstsAFEJekxWi32Hwl2zhTpeD2oH';
                    $link = 'https://wabot.myrigaming.my.id/send-message';
                    $nomorwabot = '6285809933288';
                    
                                                    $data = [
                                                        'api_key' => $rigaming,
                                                        'sender' => $nomorwabot,
                                                        'number' => $nomerhp,
                                                        'message' => $pesannya,
                                                    ];                    
                                                    $curl = curl_init();
                                                    
                                                    curl_setopt_array($curl, array(
                                                      CURLOPT_URL => $link,
                                                      CURLOPT_RETURNTRANSFER => true,
                                                      CURLOPT_ENCODING => '',
                                                      CURLOPT_MAXREDIRS => 10,
                                                      CURLOPT_TIMEOUT => 0,
                                                      CURLOPT_FOLLOWLOCATION => true,
                                                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                                      CURLOPT_CUSTOMREQUEST => 'POST',
                                                      CURLOPT_POSTFIELDS => json_encode($data),
                                                      CURLOPT_HTTPHEADER => array(
                                                        'Content-Type: application/json'
                                                      ),
                                                    ));
                                                    
                                                    $response = curl_exec($curl);
                                                    
                                                    curl_close($curl);                                                    
       //     $json_result = json_decode($chresult, true);
