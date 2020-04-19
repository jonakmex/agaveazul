package com.agaveazul.gateway.dto;

import com.agaveazul.entitiy.enums.UnitStatus;
import lombok.Data;

@Data
public class FindUnitCriteria {
    private String description;
    private UnitStatus status;
}
