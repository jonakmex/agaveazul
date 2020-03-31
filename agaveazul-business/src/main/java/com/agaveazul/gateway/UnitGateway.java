package com.agaveazul.gateway;

import com.agaveazul.entitiy.Unit;
import com.agaveazul.gateway.dto.FindUnitCriteria;

import java.util.List;

public interface UnitGateway {
    List<Unit> find(FindUnitCriteria criteria);
}
