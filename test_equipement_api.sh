#!/bin/bash

TOKEN="3|8MfEKmZjqQhAnAgnjJWgSxDRsesInUh1dW8emyt93282a5fb"
BASE_URL="http://127.0.0.1:8000/api"

echo "========================================="
echo "Testing EquipementAppartement API"
echo "========================================="
echo ""

echo "1. LIST all equipement appartements (should be empty initially)"
echo "GET $BASE_URL/equipement-appartement"
curl -s -X GET "$BASE_URL/equipement-appartement" \
  -H "Authorization: Bearer $TOKEN" | jq '.'
echo ""
echo ""

echo "2. CREATE a new equipement appartement"
echo "POST $BASE_URL/equipement-appartement"
CREATE_RESPONSE=$(curl -s -X POST "$BASE_URL/equipement-appartement" \
  -H "Authorization: Bearer $TOKEN" \
  -H "Content-Type: application/json" \
  -d '{"appartement_id": 2, "nom_equipement": "Bureau", "quantite": 1, "etat": "Neuf"}')
echo "$CREATE_RESPONSE" | jq '.'
EQUIP_ID=$(echo "$CREATE_RESPONSE" | jq -r '.id')
echo ""
echo ""

echo "3. SHOW the created equipement appartement (ID: $EQUIP_ID)"
echo "GET $BASE_URL/equipement-appartement/$EQUIP_ID"
curl -s -X GET "$BASE_URL/equipement-appartement/$EQUIP_ID" \
  -H "Authorization: Bearer $TOKEN" | jq '.'
echo ""
echo ""

echo "4. UPDATE the equipement appartement"
echo "PUT $BASE_URL/equipement-appartement/$EQUIP_ID"
curl -s -X PUT "$BASE_URL/equipement-appartement/$EQUIP_ID" \
  -H "Authorization: Bearer $TOKEN" \
  -H "Content-Type: application/json" \
  -d '{"nom_equipement": "Bureau ergonomique", "quantite": 1, "etat": "Excellent"}' | jq '.'
echo ""
echo ""

echo "5. LIST all equipement appartements (should show the updated item)"
echo "GET $BASE_URL/equipement-appartement"
curl -s -X GET "$BASE_URL/equipement-appartement" \
  -H "Authorization: Bearer $TOKEN" | jq '.'
echo ""
echo ""

echo "6. DELETE the equipement appartement"
echo "DELETE $BASE_URL/equipement-appartement/$EQUIP_ID"
DELETE_RESPONSE=$(curl -s -w "\nHTTP_STATUS:%{http_code}" -X DELETE "$BASE_URL/equipement-appartement/$EQUIP_ID" \
  -H "Authorization: Bearer $TOKEN")
echo "$DELETE_RESPONSE"
echo ""
echo ""

echo "7. LIST all equipement appartements (should be empty again)"
echo "GET $BASE_URL/equipement-appartement"
curl -s -X GET "$BASE_URL/equipement-appartement" \
  -H "Authorization: Bearer $TOKEN" | jq '.'
echo ""
echo ""

echo "========================================="
echo "All tests completed!"
echo "========================================="
